# appimage.py -for image testing
import streamlit as st

def main():
    st.title("Streamlit App")
    st.write("Welcome to my Streamlit app!")

    # Display the image (replace with your actual image path)
    st.image("path/to/your/image.jpg", use_container_width=True)

if __name__ == "__main__":
    main()
