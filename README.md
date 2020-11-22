# enigmath
## EnigMATH: create your own "encrypting machine" ([Example Site](https://zygtech.pl/enigmath/?formula=%23*pi%2Bcos%28%23%2F30*e%29*500%2Fsqrt%283%29))

Python script encoding and decoding any file with mathematical formula as your keyphrase.

As it operates on integers use multiplifier to achive greater precision. [Math functions](https://docs.python.org/3/library/math.html) to use.

1. Download `enigmath.py` and preferably make script `executable` by `chmod +x enigmath.py` 
2. Encrypt any file `./enigmath.py MyFile.zip "#*pi+cos(#/30*e)*500/sqrt(3)"` (formula `in brackets` and no need to use `math.` prefix - use `variable of iteration #` at least once in a formula!)
3. Decrypt encoded file `./enigmath.py MyFile.zip.enigmath "#*pi+cos(#/30*e)*500/sqrt(3))"` (same formula guarantees indentical `original file` saved with extension `.original`)

### For large files

1. As `EnigMATH` is heavy on resources you may find also `enigmathize.py` useful tool. Be sure to have `ZIP` and `UNZIP` installed (on `Ubuntu/Debian` use `sudo apt-get install zip unzip`)
2. Run it as `executable` after `chmod +x enigmathize.py` with name of `zipfile` to create (without `extension`), `file or folder name` and finally `encryption formula` as in `EnigMATH` itself `./enigmathize.py MyZipName /MyFolder "#*pi+cos(#/30*e)*500/sqrt(3)"`
3. Resulting file has extension `.enigmath.zip`. It consists of `password.enigmath` to decrypt with `EnigMATH` plus password protected `ZIP`
4. You can also `unpack` a file with `.enigmath.zip` extension using this tool  `./enigmathize.py MyEncryptedZip.enigmath.zip "#*pi+cos(#/30*e)*500/sqrt(3)"`

### Optionally

1. Download and copy all files to `public web folder` on any `server`. Edit `.htaccess` with maximal `upload size` and `execution time`
2. Use `index.php` to see your `formula plot` and `encrypt/decrypt` files in `web browser`
3. Script uses `enigmath.py` for files smaller than `5MB` and `enigmathize.py` for larger or zipped files
