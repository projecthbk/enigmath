#!/usr/bin/env python3
"""Author: Krzysztof Hrybacz <krzysztof@zygtech.pl>"""
"""License: GNU General Public License -- version 3"""

import io, sys, os, struct
from math import *

def encrypt(var, key):
    key = key[:len(var)]
    int_var = int.from_bytes(var, sys.byteorder)
    int_key = int.from_bytes(key, sys.byteorder)
    int_enc = int_var ^ int_key
    return int_enc.to_bytes(len(var), sys.byteorder)
    
def main():
    if (len(sys.argv)!=3):
        print("MATH ENIGMA ENCODER: Create your own any \"enrypting machine\".\nUsage: enigmath.py <filename> <math formula in python format>\nExample: enigmath.py Archive.zip \"(pi+cos(#*30))*100/sqrt(3)\"")
        quit()
    filename = sys.argv[1]
    formula = sys.argv[2]
    if (formula.count('#')==0):
        print("MATH ENIGMA ENCODER: Create your own any \"enrypting machine\".\nUse variable # as iterator at least once in formula!")
        quit()
    if (formula.count(' ')!=0 or formula.count('\n')!=0):
        print("MATH ENIGMA ENCODER: Create your own any \"enrypting machine\".\nDon't use spaces or new line characters in formula!")
        quit()
    formula = formula.replace('#','iterator')
    code = "print(" + formula +")"
    source = open(filename,'rb')
    if (filename[-9:]!='.enigmath'):
        destination = open(filename + '.enigmath','wb')
    else:
        destination = open(filename[:-9] + '.original','wb')
    index = 1
    result = 0
    n = 1
    byte = ''
    for i in range (0,ceil(os.path.getsize(filename)/2)):
        for bytepos in range (0,13):
            if (result==0 or index > len(bin(result)[2:])): 
                old_stdout = sys.stdout 
                new_stdout = io.StringIO()  
                sys.stdout = new_stdout 
                iterator = n
                exec(code)
                result = round(float(sys.stdout.getvalue().strip()))
                sys.stdout = old_stdout 
                index = 1
                n = n + 1
                bitresult = str(bin(result))[2:]
            try:
                byte = str(byte) + bitresult[bytepos]
            except:
                byte = str(byte) + '0'
            index = index + 1
        cbyte = struct.pack('!H', int(byte,2))
        sbyte = source.read(2)
        ebyte = encrypt(sbyte,cbyte)
        for onebyte in ebyte:
            destination.write(onebyte.to_bytes(1, byteorder='big'))
        byte = ''
    source.close()
    destination.close()
    
if __name__ == '__main__':
    main()
