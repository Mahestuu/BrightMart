# tests/tests_selenium/test_transaction.py
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL
from utils import login

def test_transaction_page(driver):
    login(driver)
    driver.get(f"{BASE_URL}/transaction")

    # Uji jika tidak ada transaksi
    no_transaction = driver.find_elements(By.CLASS_NAME, "no-transaction")
    if no_transaction:
        assert no_transaction[0].is_displayed(), "Pesan Belum Ada Transaksi tidak muncul"
    else:
        # Uji header transaksi
        transaction_title = WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.CLASS_NAME, "transaction-title"))
        )
        assert transaction_title.text == "Terima Kasih atas Pesanan Anda!", "Judul transaksi tidak sesuai"

        # Uji timeline status
        timeline_items = driver.find_elements(By.CLASS_NAME, "timeline-item")
        assert len(timeline_items) == 4, f"Timeline status tidak lengkap, ditemukan {len(timeline_items)} item"