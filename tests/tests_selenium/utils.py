# tests/tests_selenium/utils.py
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from config import BASE_URL, TEST_USER_EMAIL, TEST_USER_PASSWORD

def login(driver):
    driver.get(f"{BASE_URL}/login")
    email_input = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.NAME, "email"))
    )
    email_input.send_keys(TEST_USER_EMAIL)
    password_input = driver.find_element(By.NAME, "password")
    password_input.send_keys(TEST_USER_PASSWORD)
    login_button = driver.find_element(By.XPATH, "//button[@type='submit']")
    login_button.click()
    WebDriverWait(driver, 10).until(
        EC.url_contains("home")
    )