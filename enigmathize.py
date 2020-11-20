#!/usr/bin/env python3
"""Author: Krzysztof Hrybacz <krzysztof@zygtech.pl>"""
"""License: GNU General Public License -- version 3"""

import sys,os,hashlib

def main():
    if len(sys.argv)!=4:
        print("ENIGMATHIZER: Creates EnigMATH protected ZIP package for large files.\nUsage: enigmathize.py <outputzipname> <file or folder name> <formula>\nExample: enigmathize.py MyZipFile /MyFolder \"(pi+cos(#*30))*100/sqrt(3)\"")
        quit()
    zipname = sys.argv[1]
    foldername = sys.argv[2]
    formula = sys.argv[3]
    if formula.count('#')==0:
        print("ENIGMATHIZER: Creates EnigMATH protected ZIP package for large files.\nUse variable # as iterator at least once in formula!")
        quit()
    if formula.count(' ')!=0 or formula.count('\n')!=0:
        print("ENIGMATHIZER: Creates EnigMATH protected ZIP package for large files.\nDon't use spaces or new line characters in formula!")
        quit()
    password = hashlib.sha256(os.urandom(256)).hexdigest()
    os.system("zip -P " + password + " -r " + zipname + ".zip \"" + foldername + "\"")
    passfile = open("password","wt")
    passfile.write(password)
    passfile.close()
    os.system("python3 " + os.path.abspath(os.path.dirname(sys.argv[0])) + "/enigmath.py password \"" + formula + "\"")
    os.system("zip -r " + zipname + ".enigmath.zip " + zipname + ".zip password.enigmath")
    os.remove("password")
    os.remove("password.enigmath")
    os.remove(zipname + ".zip")
            
if __name__ == '__main__':
    main()
