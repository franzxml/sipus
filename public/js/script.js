// public/js/script.js

// Notifikasi sederhana
document.addEventListener("DOMContentLoaded", () => {
  const alerts = document.querySelectorAll(".alert");
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.display = "none";
    }, 4000); // notifikasi hilang setelah 4 detik
  });
});

// Konfirmasi sebelum menghapus data
function confirmDelete(event) {
  if (!confirm("Apakah anda yakin ingin menghapus data ini?")) {
    event.preventDefault();
  }
}

// Toggle tema terang/gelap sederhana
function toggleTheme() {
  document.body.classList.toggle("dark-mode");
}

// Tambahkan style dark mode secara dinamis
const style = document.createElement("style");
style.innerHTML = `
  .dark-mode {
    background-color: #2c3e50;
    color: #ecf0f1;
  }
  .dark-mode header, .dark-mode footer {
    background: #1a252f;
  }
  .dark-mode table th {
    background: #34495e;
  }
`;
document.head.appendChild(style);