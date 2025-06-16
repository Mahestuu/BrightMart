# tests/test_karir.py
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL

def test_karir_page(driver):
    driver.get(f"{BASE_URL}/karir")

    # Uji judul "Gabung Bersama Kami"
    title = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//h2[text()='Gabung Bersama Kami!']"))
    )
    assert title, "Judul Gabung Bersama Kami tidak ditemukan"

    # Uji tombol Lamar Sekarang
    apply_button = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.CLASS_NAME, "apply-button"))
    )
    assert apply_button.is_enabled(), "Tombol Lamar Sekarang tidak aktif"