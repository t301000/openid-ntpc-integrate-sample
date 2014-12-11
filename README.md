# 新北市 OpenID 整合應用範例

示範如何讓新北市 OpenID 與網站現有的帳號並存。

  - 可用網站現有的帳號登入
  - 可透過 OpenID 驗證登入
  - 第一次透過 OpenID 登入時新增 user 資料進資料庫
  - 第二次以後透過 OpenID 登入時更新 user 資料

## 安裝

1. 下載並解壓縮，得到 openid-ntpc-integrate-sample 資料夾
2. 將 openid-ntpc-integrate-sample 資料夾移至網站目錄下
3. 匯入 database.sql 建立 openidtest 資料庫、 users 資料表與預設帳號
4. 修改 conn.php 中資料庫連線設定

## 注意事項

本範例僅提供實做參考，並未考量相關資安問題，請勿用於正式上線網站。