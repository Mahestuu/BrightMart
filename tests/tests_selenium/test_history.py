# tests/tests_selenium/test_history.py
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL
from utils import login

def test_history_page(driver):
    login(driver)
    driver.get(f"{BASE_URL}/orders/history")

    # Uji jika tidak ada transaksi
    no_transaction = driver.find_elements(By.XPATH, "//h3[text()='Belum Ada Transaksi']")
    if no_transaction:
        assert no_transaction[0].is_displayed(), "Pesan Belum Ada Transaksi tidak muncul"
    else:
        # Uji keberadaan daftar transaksi
        order_items = WebDriverWait(driver, 10).until(
            EC.presence_of_all_elements_located((By.CLASS_NAME, "order-item"))
        )
        assert len(order_items) > 0, "Daftar transaksi tidak ditemukan"