<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Цены SOL и ETH</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f4f4f4; }
    .card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 400px; margin: auto; }
    h2 { margin-top: 0; }
  </style>
</head>
<body>
  <div class="card">
    <h2>Текущие цены</h2>
    <p><strong>SOLUSDT:</strong> <span id="sol">—</span></p>
    <p><strong>ETHUSDT:</strong> <span id="eth">—</span></p>
    <p><strong>Индекс:</strong> <span id="index">—</span></p>
    <p style="font-size: 0.9em; color: #666;">🕒 Обновлено: <span id="time">—</span></p>
  </div>

  <script>
    let prices = {};
    const ws = new WebSocket("wss://fstream.binance.com/stream?streams=solusdt@miniTicker/ethusdt@miniTicker");

    ws.onmessage = (event) => {
      const data = JSON.parse(event.data).data;
      const symbol = data.s;
      const price = parseFloat(data.c);

      prices[symbol] = price;

      if (symbol === "SOLUSDT") document.getElementById("sol").textContent = price.toFixed(4);
      if (symbol === "ETHUSDT") document.getElementById("eth").textContent = price.toFixed(4);

      if (prices.SOLUSDT && prices.ETHUSDT) {
        const index = (prices.SOLUSDT + prices.ETHUSDT) / 2;
        document.getElementById("index").textContent = index.toFixed(4);
      }

      const now = new Date().toLocaleString();
      document.getElementById("time").textContent = now;
    };
  </script>
</body>
</html>
