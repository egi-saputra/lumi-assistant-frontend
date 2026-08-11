import { ref, onMounted, watch } from "vue";

// Ref di luar function = singleton, state tema tetap sinkron
// walau useDarkMode() dipanggil dari beberapa komponen berbeda.
const isDark = ref(false);

export function useDarkMode() {
    const toggle = () => {
        isDark.value = !isDark.value;
    };

    onMounted(() => {
        // Baca class yang sudah di-set oleh inline script anti-flash di <head>
        // (lihat catatan app.blade.php) supaya toggle langsung sinkron saat mount.
        isDark.value = document.documentElement.classList.contains("dark");
    });

    watch(isDark, (value) => {
        if (typeof document === "undefined") return;
        document.documentElement.classList.toggle("dark", value);
        try {
            localStorage.setItem("lumi-theme", value ? "dark" : "light");
        } catch (e) {
            // localStorage bisa gagal (private mode dsb) — abaikan, bukan fatal
        }
    });

    return { isDark, toggle };
}
