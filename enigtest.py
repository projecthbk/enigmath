#!/usr/bin/env python3
"""Author: Krzysztof Hrybacz <krzysztof@zygtech.pl>"""
"""License: GNU General Public License -- version 3"""

import sys,json
from math import *

def main():
    if len(sys.argv)!=2:
        print("MATH ENIGMA TESTER: Create your own any \"enrypting machine\".\nUsage: enigtest.py <math formula in python format>\nExample: enigmath.py \"(pi+cos(#*30))*100/sqrt(3)\"")
        quit()
    formula = sys.argv[1]
    if formula.count('#')==0:
        print("MATH ENIGMA TESTER: Create your own any \"enrypting machine\".\nUse variable # as iterator at least once in formula!")
        quit()
    if formula.count(' ')!=0 or formula.count('\n')!=0:
        print("MATH ENIGMA TESTER: Create your own any \"enrypting machine\".\nDon't use spaces or new line characters in formula!")
        quit()
    formula = formula.replace('#','iterator')
    result = 0
    n = 1  
    results = []
    while n<101:
        iterator = n
        result = round(abs(eval(formula))) 
        n = n + 1
        results.append(result)
    print(json.dumps(results))
    
if __name__ == '__main__':
    main()
