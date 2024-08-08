const express = require('express');
const app = express();
let fixedSignal = null;

app.use(express.json());
app.use(express.static('public')); // Для раздачи файлов из папки public

// Установка сигнала и режима
app.post('/set-signal-mode', (req, res) => {
    const { mode, signal } = req.body;
    if (mode === 'fixed') {
        fixedSignal = signal;
    } else {
        fixedSignal = null;
    }
    res.send({ status: 'success', mode: mode });
});

// Получение сигнала
app.get('/get-signal', (req, res) => {
    if (fixedSignal) {
        res.send({ signal: fixedSignal });
    } else {
        const signal = (Math.random() * (3.6 - 1) + 1).toFixed(1);
        res.send({ signal: signal });
    }
});

// Запуск сервера
app.listen(3000, () => {
    console.log('Server is running on port 3000');
});
