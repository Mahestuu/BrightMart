# tests/test_lokasitoko.py
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL

def test_lokasitoko_page(driver):
    driver.get(f"{BASE_URL}/lokasitoko")

    # Uji keberadaan tabel toko
    table = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.CLASS_NAME, "store-table"))
    )
    assert table, "Tabel lokasi toko tidak ditemukan"

    # Uji keberadaan iframe peta
    iframes = driver.find_elements(By.TAG_NAME, "iframe")
    assert len(iframes) > 0, "Peta Google Maps tidak ditemukan"

    # Uji konten tabel
    store_name = driver.find_element(By.XPATH, "//td[text()='Toko Surabaya']")
    assert store_name, "Nama toko Surabaya tidak ditemukan di tabel"