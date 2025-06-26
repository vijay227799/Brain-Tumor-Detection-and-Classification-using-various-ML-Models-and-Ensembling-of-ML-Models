import streamlit as st
import requests
import json
#This is for login successful streamlit webpage with firebase database.
# Replace with your Firebase Web API Key
FIREBASE_WEB_API_KEY = 'AIzaSyDTPopoMsLVCDFlz3hYeCI3_VR-7KnkYXk'#This is enough to establish connection with firebase app not the firebse database

def sign_in_with_email_and_password(email, password, return_secure_token=True):
    payload = json.dumps({
        "email": email,
        "password": password,
        "return_secure_token": return_secure_token
    })
    rest_api_url = "https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword"
    response = requests.post(rest_api_url, params={"key": FIREBASE_WEB_API_KEY}, data=payload)
    return response.json()

def main1():
    st.title("Streamlit Login Form")

    email = st.text_input("Email")
    password = st.text_input("Password", type="password")

    if st.button("Log in"):
        try:
            result = sign_in_with_email_and_password(email, password)
            if "idToken" in result:
                st.success("Login successful!")
                st.switch_page("app1.py")
            else:
                st.error("Invalid credentials. Please try again.")
        except Exception as e:
            st.error(f"Error: {str(e)}")

if __name__ == "__main__":
    main1()
