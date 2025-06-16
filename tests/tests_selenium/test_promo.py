# tests/test_promo.py
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL

def test_promo_page(driver):
    driver.get(f"{BASE_URL}/promo")

    # Uji keberadaan kartu promo
    promo_cards = WebDriverWait(driver, 10).until(
        EC.presence_of_all_elements_located((By.CLASS_NAME, "promo-card"))
    )
    assert len(promo_cards) >= 8, f"Kartu promo kurang dari yang diharapkan, ditemukan {len(promo_cards)}"

    # Uji tautan Lihat Detail pada kartu promo pertama
    detail_link = promo_cards[0].find_element(By.CLASS_NAME, "btn-promo")
    assert detail_link.is_enabled(), "Tautan Lihat Detail tidak aktif"