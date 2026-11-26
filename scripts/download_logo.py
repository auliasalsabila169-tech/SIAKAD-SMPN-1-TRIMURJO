import urllib.request
import re
import os

target = r"d:\SEMESTER 5\TUGAS UTS BASIS DATA LANJUT\logo_um_metro.png"
url = "https://id.wikipedia.org/wiki/Berkas:Logo_UM_Metro.png"
headers = {"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"}

try:
    req = urllib.request.Request(url, headers=headers)
    with urllib.request.urlopen(req) as resp:
        html = resp.read().decode('utf-8')
        m = re.search(r'https://upload\.wikimedia\.org/wikipedia/id/[^\"]+Logo_UM_Metro\.png', html)
        if not m:
            m = re.search(r'//upload\.wikimedia\.org/wikipedia/id/[^\"]+Logo_UM_Metro\.png', html)
            if m:
                img_url = "https:" + m.group(0)
            else:
                img_url = None
        else:
            img_url = m.group(0)
            
        if img_url:
            print("Found URL:", img_url)
            req2 = urllib.request.Request(img_url, headers=headers)
            with urllib.request.urlopen(req2) as r2, open(target, "wb") as f:
                f.write(r2.read())
            print("Downloaded logo, size:", os.path.getsize(target))
        else:
            print("Image URL not found in page")
except Exception as e:
    print("Error:", e)
