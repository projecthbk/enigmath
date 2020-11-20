# enigmath
## EnigMATH: create your own "encrypting machine" ([Example Site](https://zygtech.pl/enigmath/?formula=%23*pi%2Bcos%28%23%2F30*e%29*500%2Fsqrt%283%29))

Python script encoding and decoding any file with mathematical formula as your keyphrase.

As it operates on integers use multiplifier to achive greater precision. [Math functions](https://docs.python.org/3/library/math.html) to use.

1. Download `enigmath.py` and preferably make script `executable` by `chmod +x enigmath.py` 
2. Encrypt any file `./enigmath.py MyFile.zip "#*pi+cos(#/30*e)*500/sqrt(3)"` (formula `in brackets` and no need to use `math.` prefix - use `variable of iteration #` at least once in a formula!)
3. Decrypt encoded file `./enigmath.py MyFile.zip.enigmath "#*pi+cos(#/30*e)*500/sqrt(3))"` (same formula guarantees indentical `original file` saved with extension `.original`)

### Optionally

1. Download and copy all files to `public web folder` 
2. Use `index.php` to see your `formula plot` and `encrypt/decrypt` files in `browser`

### For large files

1. As `EnigMATH` is heavy on resources you may find also `enigmathizer.py` useful tool
2. Run it as `executable` by `chmod +x enigmath.py` with name of `zipfile` to create (without `extension`), `file`, `folder name` or `wildcard` and finally `encryption formula` as in `EnigMATH` itself.
3. Resulting file has extension `.enigmath.zip`. It consists of `password.enigmath` to decrypt with `EnigMATH` plus password protected `ZIP`.
