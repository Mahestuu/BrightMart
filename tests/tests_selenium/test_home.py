# tests/test_home.py
import pytest
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL

def test_home_page(driver):
    driver.get(BASE_URL)

    # Uji keberadaan carousel
    carousel = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.CLASS_NAME, "carousel-container"))
    )
    assert carousel, "Carousel tidak ditemukan"

    # Uji tombol next carousel
    next_button = driver.find_element(By.CLASS_NAME, "next")
    next_button.click()
    WebDriverWait(driver, 5).until(
        EC.presence_of_element_located((By.CSS_SELECTOR, ".carousel-slide img[alt='Gambar 2']"))
    )
    assert "Gambar 2" in driver.page_source, "Carousel tidak bergeser ke slide berikutnya"

    # Uji tautan "Selengkapnya" pada hero-section
    hero_link = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.LINK_TEXT, "SELENGKAPNYA ➔"))
    )
    hero_link.click()
    WebDriverWait(driver, 10).until(
        EC.url_contains("product")
    )
    assert "product" in driver.current_url, "Tautan Selengkapnya pada hero-section tidak berfungsi"

    # Uji animasi AOS
    aos_elements = driver.find_elements(By.CSS_SELECTOR, "[data-aos='fade-down']")
    assert len(aos_elements) > 0, "Animasi AOS tidak ditemukan"

    # Uji navigasi navbar
    navbar_links = driver.find_elements(By.CSS_SELECTOR, ".nav-menu a")
    assert any("Beranda" in link.text for link in navbar_links), "Tautan Beranda di navbar tidak ditemukan"