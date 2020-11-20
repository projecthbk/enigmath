# enigmath
## EnigMATH: create your own "encrypting machine"

Python script encoding and decoding any file with mathematical formula as your keyphrase.

As it operates on integers use multiplifier to achive greater precision. Avoid getting to zeros.

1. Download `enigmath.py` and preferably make script `executable` by `chmod +x enigmath.py` ([Example Site](https://zygtech.pl/enigmath/))
2. Encrypt any file `./enigmath.py MyFile.zip "(pi+cos(#*30))*100/sqrt(3)"` (formula `in brackets` and no need to use `math.` prefix - use `variable of iteration #` at least once in a formula!)
3. Decrypt encoded file `./enigmath.py MyFile.zip.enigmath "(pi+cos(#*30))*100/sqrt(3)"` (same formula guarantees indentical `original file` saved with extension `.original`)

### Optionaly

1. Download and copy all files to `public web folder` 
2. Use `index.html` to see your `formula plot` and `encrypt/decrypt` files in `browser`
