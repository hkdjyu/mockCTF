# ✅ Web-46 解題說明 — 隱藏的產品

## 題目描述
請找出隱藏的產品。

## 難度
★★☆☆☆（2星）

## 種類
WEB, SQL

## 建議工具
- 瀏覽器
- DevTools
- SQL 語法與註解基礎

## 解題步驟
1. 打開「開發者人員工具」，瀏覽`Elements`
2. 發現以下元素：
    ```
    <button onclick="sendQuery('SELECT id, name, price FROM products WHERE price > 10 ORDER BY price DESC')">查詢價格大於10的產品</button>
    ```
3. 觀察SQL query `SELECT id, name, price FROM products WHERE price > 10 ORDER BY price DESC`
4. 修改SQL query為`SELECT id, name, price FROM products ORDER BY price DESC`

## Flag
`flag{y0u_f0und_th3_fl4g_in_th3_pr0ducts}`
