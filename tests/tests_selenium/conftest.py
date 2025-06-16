# tests/conftest.py
import pytest
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from config import CHROMEDRIVER_PATH, BASE_URL

@pytest.fixture(scope="module")
def driver():
    service = Service(CHROMEDRIVER_PATH)
    options = webdriver.ChromeOptions()
    options.add_argument("--start-maximized")  # Membuka browser dalam mode layar penuh
    options.add_argument("--disable-notifications")  # Menonaktifkan notifikasi
    driver = webdriver.Chrome(service=service, options=options)
    driver.get(BASE_URL)
    yield driver
    driver.quit()