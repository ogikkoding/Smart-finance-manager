const display = document.getElementById("display");

function tambahDisplay(nilai) {
  display.value += nilai;
}

function hapusSemua() {
  display.value = "";
}

function hapusSatu() {
  display.value = display.value.slice(0, -1);
}

function hitung() {
  try {
    display.value = eval(display.value);
  } catch {
    display.value = "Error";
  }
}

// Keyboard Support

document.addEventListener("keydown", function (e) {
  const tombol = "0123456789+-*/.%";

  if (tombol.includes(e.key)) {
    display.value += e.key;
  }

  if (e.key === "Enter") {
    e.preventDefault();

    hitung();
  }

  if (e.key === "Backspace") {
    hapusSatu();
  }

  if (e.key === "Escape") {
    hapusSemua();
  }
});
