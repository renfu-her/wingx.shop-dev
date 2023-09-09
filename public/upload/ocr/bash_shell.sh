#!/bin/bash

# 獲取開始時間的秒數
start_seconds=$(date +%s)

# 執行 tesseract 命令
tesseract text-ocr-1.png output_text -l chi_tra+eng

# 獲取結束時間的秒數
end_seconds=$(date +%s)

# 計算並輸出總共花費的時間
elapsed_seconds=$((end_seconds - start_seconds))
echo "總共時間: $elapsed_seconds 秒"

