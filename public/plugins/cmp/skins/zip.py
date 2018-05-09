# -*- coding: utf-8 -*-
import os
import zipfile

os.chdir('./fm')
print(os.getcwd())

azip = zipfile.ZipFile('../fm.zip','w')
for current_path, subfolders, filesname in os.walk(r'./'):
    for name in filesname:
        azip.write('./' + name,compress_type=zipfile.ZIP_LZMA)
azip.close()
print("成功！")
