<?php
/* =====================================================
   KALKULATOR
===================================================== */
?>
<style>
    .calculator {
        max-width: 440px;
        margin: 20px auto
    }

    .calculator-card {
        border: none;
        border-radius: 20px;
        overflow: hidden
    }

    .calculator-header {
        background: linear-gradient(135deg, #0d6efd, #4a8cff);
        color: #fff;
        padding: 16px 20px
    }

    .calculator-body {
        padding: 20px;
        background: #f8f9fa
    }

    #display {
        width: 100%;
        height: 80px;
        border: none;
        border-radius: 14px;
        background: #fff;
        text-align: right;
        font-size: 2rem;
        font-weight: bold;
        padding: 15px;
        margin-bottom: 18px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .08)
    }

    .calculator-buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px
    }

    .cal-btn {
        height: 62px;
        border: none;
        border-radius: 14px;
        font-size: 22px;
        font-weight: bold;
        transition: .2s
    }

    .cal-btn:hover {
        transform: translateY(-2px)
    }

    .cal-btn:active {
        transform: scale(.96)
    }

    .number {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .08)
    }

    .number:hover {
        background: #efefef
    }

    .operator {
        background: #0d6efd;
        color: #fff
    }

    .operator:hover {
        background: #0b5ed7
    }

    .equal {
        background: #198754;
        color: #fff
    }

    .equal:hover {
        background: #157347
    }

    .clear {
        background: #dc3545;
        color: #fff
    }

    .back {
        background: #ffc107
    }

    .zero {
        grid-column: span 2
    }

    .history-box {
        display: none;
        margin-bottom: 18px;
        background: #fff;
        border-radius: 14px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        max-height: 220px;
        overflow: auto
    }

    .history-item {
        padding: 8px 0;
        border-bottom: 1px solid #eee
    }
</style>

<div class="calculator">
    <div class="card shadow-lg calculator-card">

        <div class="calculator-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-calculator"></i> Kalkulator</h4>
                <div>
                    <button class="btn btn-light btn-sm mr-2" onclick="toggleHistory()">
                        <i class="fas fa-history"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="clearHistory()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="calculator-body">

            <input id="display" type="text" readonly>

            <div id="historyBox" class="history-box">
                <h6><i class="fas fa-history"></i> Riwayat</h6>
                <div id="historyList">
                    <small class="text-muted">Belum ada riwayat.</small>
                </div>
            </div>

            <div class="calculator-buttons">

                <button class="cal-btn clear" onclick="clearDisplay()">C</button>
                <button class="cal-btn back" onclick="backspace()">⌫</button>
                <button class="cal-btn operator" onclick="append('%')">%</button>
                <button class="cal-btn operator" onclick="append('/')">÷</button>

                <button class="cal-btn number" onclick="append('7')">7</button>
                <button class="cal-btn number" onclick="append('8')">8</button>
                <button class="cal-btn number" onclick="append('9')">9</button>
                <button class="cal-btn operator" onclick="append('*')">×</button>

                <button class="cal-btn number" onclick="append('4')">4</button>
                <button class="cal-btn number" onclick="append('5')">5</button>
                <button class="cal-btn number" onclick="append('6')">6</button>
                <button class="cal-btn operator" onclick="append('-')">−</button>

                <button class="cal-btn number" onclick="append('1')">1</button>
                <button class="cal-btn number" onclick="append('2')">2</button>
                <button class="cal-btn number" onclick="append('3')">3</button>
                <button class="cal-btn operator" onclick="append('+')">+</button>

                <button class="cal-btn number zero" onclick="append('0')">0</button>
                <button class="cal-btn number" onclick="append('.')">.</button>
                <button class="cal-btn equal" onclick="calculate()">=</button>

            </div>
        </div>
    </div>
</div>

<script>
    const display = document.getElementById("display");
    let historyData = [];

    function append(v) {
        display.value += v;
    }

    function clearDisplay() {
        display.value = "";
    }

    function backspace() {
        display.value = display.value.slice(0, -1);
    }

    function calculate() {
        if (display.value === "") return;
        try {
            const expr = display.value;
            const result = eval(expr);
            display.value = result;
            historyData.unshift(expr + " = " + result);
            renderHistory();
        } catch (e) {
            display.value = "Error";
        }
    }

    function toggleHistory() {
        const box = document.getElementById("historyBox");
        box.style.display = (box.style.display === "block") ? "none" : "block";
    }

    function renderHistory() {
        const list = document.getElementById("historyList");
        if (historyData.length === 0) {
            list.innerHTML = "<small class='text-muted'>Belum ada riwayat.</small>";
            return;
        }
        list.innerHTML = historyData.map(i => "<div class='history-item'>" + i + "</div>").join("");
    }

    function clearHistory() {
        historyData = [];
        renderHistory();
    }

    document.addEventListener("keydown", e => {
        const ok = "0123456789+-*/.%";
        if (ok.includes(e.key)) append(e.key);
        if (e.key === "Enter") {
            e.preventDefault();
            calculate();
        }
        if (e.key === "Backspace") {
            e.preventDefault();
            backspace();
        }
        if (e.key === "Escape") {
            clearDisplay();
        }
    });
</script>