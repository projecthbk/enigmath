#!/usr/bin/env python3
"""Author: Krzysztof Hrybacz <krzysztof@zygtech.pl>"""
"""License: GNU General Public License -- version 3"""

import sys
from math import *

def main():
    if len(sys.argv)!=3:
        print("MATH ENIGMA ENCODER: Create your own any \"enrypting machine\".\nUsage: enigmath.py <filename> <math formula in python format>\nExample: enigmath.py Archive.zip \"(pi+cos(#*30))*100/sqrt(3)\"")
        quit()
    filename = sys.argv[1]
    formula = sys.argv[2]
    if formula.count('#')==0:
        print("MATH ENIGMA ENCODER: Create your own any \"enrypting machine\".\nUse variable # as iterator at least once in formula!")
        quit()
    if formula.count(' ')!=0 or formula.count('\n')!=0:
        print("MATH ENIGMA ENCODER: Create your own any \"enrypting machine\".\nDon't use spaces or new line characters in formula!")
        quit()
    formula = formula.replace('#','iterator')
    source = open(filename,'rb')
    if filename[-9:]!='.enigmath':
        destination = open(filename + '.enigmath','wb')
    else:
        destination = open(filename[:-9] + '.original','wb')
    index = 1
    result = 0
    n = 1
    byte = ''
    while True:
        for bytepos in range (0,7):
            if result==0 or index > len(bin(result)[2:]): 
                iterator = n
                result = round(eval(formula)) 
                index = 1
                n = n + 1
                bitresult = str(bin(result))[2:]
            byte = str(byte) + bitresult[bytepos]
            index = index + 1
        cbyte = int(byte,2)
        rbyte = source.read(1)
        if not rbyte:
            break
        sbyte = int.from_bytes(rbyte,byteorder='big')
        ebyte = sbyte ^ cbyte
        destination.write(ebyte.to_bytes(1,byteorder='big'))
        byte = ''
    source.close()
    destination.close()
    
if __name__ == '__main__':
    main()
