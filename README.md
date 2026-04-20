# wingx-shop

這是一個以 Laravel 建置的電商網站專案，包含前台購物網站與後台管理系統。

## 專案用途

此專案主要用於經營一般商品電商流程，涵蓋：
- 商品分類與商品頁展示
- 購物車與結帳流程
- 會員登入、註冊、個人資料管理
- 訂單查詢與訂單狀態追蹤
- 後台商品、分類、圖片、訂單、Banner、最新消息、Q&A、運送設定管理

## 主要功能

### 前台
- 首頁
- 商品分類頁
- 商品詳細頁
- 購物車
- 結帳
- 訂單列表
- 會員資料
- 登入 / 註冊 / 忘記密碼
- 聯絡我們
- Q&A
- 隱私權政策

### 後台
- 管理員管理
- 商品管理
- 商品分類管理
- 商品圖片管理
- 商品組合管理
- 訂單管理
- Banner 管理
- 最新消息管理
- Q&A 管理
- 運送設定管理
- 政策內容管理

## 技術架構
- Laravel 10
- PHP 8.1+
- Vite
- MySQL

## 第三方整合
- 綠界金流 / 物流相關套件
- 藍新金流套件
- Facebook 登入
- LINE 登入
- 驗證碼

## 專案定位

從目前程式結構與路由判斷，這是一個完整的電商網站系統，名稱為 `wingx-shop`，資料庫名稱也是 `wingx-shop`。

## 綠界 ECPay 設定說明

### 設定原則
- 先使用測試資料驗證金流、物流、電子發票流程。
- 測試沒問題後，再把 `.env` 中的 `ECPAY_MODE` 切成 `production`，並補上正式資料。
- 測試與正式帳號/金鑰原始資料可參考：`docs/帳號密碼.md`

### 主要 `.env` 參數
- `ECPAY_MODE=test|production`
- `ECPAY_CALLBACK_BASE_URL`
- 金流：
  - `ECPAY_TEST_MERCHANT_ID`
  - `ECPAY_TEST_HASH_KEY`
  - `ECPAY_TEST_HASH_IV`
  - `ECPAY_PROD_MERCHANT_ID`
  - `ECPAY_PROD_HASH_KEY`
  - `ECPAY_PROD_HASH_IV`
- 物流：
  - `ECPAY_LOGISTICS_TEST_MERCHANT_ID`
  - `ECPAY_LOGISTICS_TEST_HASH_KEY`
  - `ECPAY_LOGISTICS_TEST_HASH_IV`
  - `ECPAY_LOGISTICS_PROD_MERCHANT_ID`
  - `ECPAY_LOGISTICS_PROD_HASH_KEY`
  - `ECPAY_LOGISTICS_PROD_HASH_IV`
- 電子發票：
  - `ECPAY_INVOICE_TEST_MERCHANT_ID`
  - `ECPAY_INVOICE_TEST_HASH_KEY`
  - `ECPAY_INVOICE_TEST_HASH_IV`
  - `ECPAY_INVOICE_PROD_MERCHANT_ID`
  - `ECPAY_INVOICE_PROD_HASH_KEY`
  - `ECPAY_INVOICE_PROD_HASH_IV`

### 注意事項
- 正式金流 HashIV 與正式物流 / 發票 HashIV 不同，不可混用。
- 金流通知與前台返回已拆成：
  - server notify：`POST /cart/payment/notify`
  - client return：`POST /cart/thanks`
- 物流門市回傳相關：
  - 地圖回寫：`POST /cart/rewrite`
  - 物流 server reply：`POST /cart/server/reply`
  - 物流 client reply：`POST /cart/client/reply`
- 既有測試入口：
  - `GET /test/queryOrderStatus`
  - `GET /test/getLogisticsStatus`
  - `GET /test/eInvoice/{order_no}`

### 本次調整紀錄
- 已完成 `docs/plans/2026-04-20-ecpay-flow-alignment.md` 的 Task 1 ~ Task 6。
- 包含：設定集中化、金流 notify/return 分流、物流門市資料保存修正、物流查詢防呆、電子發票設定分流。
