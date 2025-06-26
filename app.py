import streamlit as st
import matplotlib.pyplot as plt
import cv2
import numpy as np
import joblib

# Load the trained model and data
ensemble1 = joblib.load('ensemble1.joblib') #This loads the trained model file to frontend code where svm_model.joblib(Similar is data.joblib - both of these should be in same directory) is the intermediate file which contains unreadable information whcih is loaded with model from jupyter.
sv = joblib.load('svm_model.joblib') 
knn = joblib.load('knn_model.joblib')
dt_classifier = joblib.load('dt_classifier_model.joblib')  
regr = joblib.load('regr_model.joblib') 
rf_classifier = joblib.load('rf_classifier_model.joblib') 
mlp = joblib.load('mlp_model.joblib') 
lg = joblib.load('lg_model.joblib') 
xtrain, ytrain, xtest, ytest = joblib.load('data.joblib')

# Dictionary to map predictions to labels
dec = {0: 'Result: Congratulations, you are free from Brain tumor', 1: 'Result: Positive Tumor, don\'t worry you will get well soon... Good luck', 2:'Please Insert a proper image'}

# Set page title and icon
st.set_page_config(page_title="Brain Tumor Detection", page_icon=":brain:", layout="wide")

# Custom CSS for enhancing the UI
st.markdown(
    """
    <style>
    body {
        background-color: #05C3DD;
        color: blue;
        font-family: 'Arial', sans-serif;
        overflow: hidden; /* Remove vertical scrollbar */
    }
    .main {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: none; /* Remove container border */
    }
    .stButton > button {
        background-color: #007BFF;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
    }
    .stButton > button:hover {
        background-color: #0056b3;
    }
    .stFileUploader {
        text-align: center;
    }
    h1, h2, h3, h4, h5, h6 {
        text-align: center;
        color: #2c3e50;
    }
    .stMarkdown {
        font-size: 18px;
        color: #2c3e50;
        text-align: center;
    }
    .stImage img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
    """,
    unsafe_allow_html=True
)

# Main container
st.markdown("<div class='main'>", unsafe_allow_html=True)

# Brain Tumor Detection title
#st.title("Brain Tumor Detection")
st.markdown("<h1 style='text-align: center;font-style:italic ;font-size: 72px;'>BRAINSCAN AI</h1>", unsafe_allow_html=True)
uploaded_file = st.file_uploader("Select an image", type=["jpg", "jpeg", "png"], help="Upload a brain MRI image")

# Documentation button
if st.button("Documentation"):
    st.title("Documentation")
    
    st.markdown(
        """
        ### Brain Tumor Detection Model

        This model uses a Support Vector Machine (SVM) to detect brain tumors from MRI images.

        ### Model Accuracy

        The model has an accuracy of {:.2f}% on the test dataset.

        ### How to Use

        Simply upload a brain MRI image and click the "Predict" button to get the result.
        """.format(sv.score(xtest, ytest) * 100),
        unsafe_allow_html=True
    )
    st.markdown(""""# BrainScanAI
## Brain Tumor Classifier

### BrainScanAI - Brain Tumor Classification

Welcome to BrainScanAI!!
The Powerful Brain Tumor Classifier

This is the official documentation for BrainScanAI. If you would like to contribute to this documentation, you are welcome to do so. We would appreciate your valuable documentation feedback and critiques.

## Introduction

BrainScanAI is an advanced machine learning project designed to classify brain tumors with high precision using MRI images. Leveraging state-of-the-art algorithms, BrainScanAI can accurately identify and categorize brain tumors into three main classes: Glioma, Meningioma, and Pituitary Tumor. This project aims to assist medical professionals in diagnosing brain tumors more efficiently and accurately, ultimately leading to better patient outcomes.

---



## Building and IDE Integration

### Prerequisites

Building BrainScanAI from source is the first crucial step in contributing to the BrainScanAI project. You will need to install Python (preferably version 3.8 or higher), Git, and any required machine learning libraries such as TensorFlow, Keras, or PyTorch, along with other dependencies listed in the project's requirements file.

BrainScanAI is a Python-based project that employs machine learning algorithms for brain tumor classification. The main build script, typically `setup.py` or a similar file located in the root of the project directory, defines various tasks for setting up the environment and dependencies.

The build process uses the Python interpreter set up in your environment. Ensure you have a virtual environment activated to manage dependencies efficiently. If the project requires specific environment variables or configurations, these should be set accordingly before running the build.
                

### IDE Integration

To streamline development, you can integrate BrainScanAI with your preferred Integrated Development Environment (IDE). Here are instructions for two popular IDEs:

#### Visual Studio Code (VS Code)

 Open Project Folder**: Open the BrainScanAI project folder in VS Code.
 Select Python Interpreter**: Select the virtual environment's Python interpreter.
    Open the Command Palette (Ctrl+Shift+P)
    Type `Python: Select Interpreter`
    Choose the interpreter from the virtual environment (e.g., `.venv/bin/python`)

## PyCharm

## Training the Model

Training the machine learning model is a critical step in building BrainScanAI. This process involves feeding the model with a large dataset of labeled MRI images to enable it to learn and make accurate classifications.

### Steps Taken  to Train the Model

 **Prepare the Dataset**: Ensure you have the dataset of MRI images properly organized and labeled.
 **Initiate Training**: Run the training script to start the training process.
   ```bash
   python train.py --dataset path_to_dataset
   ```
   This may take a significant amount of time depending on the size of the dataset and the complexity of the model.
 **Monitor Training**: Keep an eye on the training process, ensuring it progresses without errors. You can use tools like TensorBoard to visualize the training metrics.
 **Save the Trained Model**: Once training is complete, the trained model files will be saved in the specified directory.

---

## Running the Classifier

After training the model, you can use it to classify new MRI images and determine the presence and type of brain tumor.

### Classification Steps

 **Load the Trained Model**: Ensure the trained model is loaded correctly.
 **Run the Classification Script**: Use the classification script to predict the class of a new MRI image.
 **View the Results**: The script will output the classification results, indicating whether the image contains a Glioma, Meningioma, or Pituitary Tumor.

---

## System Requirements

To successfully build and run BrainScanAI, your system should meet the following requirements:

### Hardware Requirements

 **Processor**: Multi-core CPU (Quad-core or higher recommended)
 **Memory**: 16 GB RAM or higher
 **Storage**: SSD with at least 50 GB of free space
 **GPU**: NVIDIA GPU with CUDA support (recommended for faster training)

### Software Requirements

 **Operating System**: Windows 10, macOS, or a modern Linux distribution
 **Python**: Version 3.8 or higher
 **Dependencies**: All necessary libraries and dependencies listed in `requirements.txt`
 **Development Tools**: Git, virtual environment tools, and a compatible IDE

---

## Future Directions

The development of BrainScanAI is an ongoing process. Here are some future directions and enhancements planned for the project:

 Expand Dataset**: Include a wider variety of brain tumor types and more diverse MRI images.
 Integrate Multi-Modal Imaging Data**: Enhance the model's learning process by incorporating data from different imaging modalities.
 Explore Transfer Learning**: Use pre-trained models and fine-tune them for specific classification tasks to improve performance.
 Develop an Intuitive User Interface**: Create a user-friendly interface for clinicians to interact with the model and provide feedback.
 Continuous Model Improvement**: Implement mechanisms for continuous model retraining and improvement based on new data and feedback.

---

## Conclusion

BrainScanAI demonstrates the potential of machine learning algorithms in revolutionizing brain tumor classification. The project's high accuracy and sensitivity underscore its capability to assist medical professionals in making precise diagnoses, thereby improving patient outcomes. By leveraging advanced deep learning techniques and continually refining the model, BrainScanAI aims to become an indispensable tool in the field of medical imaging.

---

We hope this comprehensive documentation provides a clear understanding of the BrainScanAI project and its potential impact. If you have any questions or need further assistance, please feel free to reach out to the BrainScanAI team. Thank you for your interest and support!

""")

if uploaded_file is not None:
    img = cv2.imdecode(np.frombuffer(uploaded_file.read(), np.uint8), cv2.IMREAD_GRAYSCALE)
    img = cv2.resize(img, (200, 200))
    img = img.reshape(1, -1) / 255

    # Predict button
    if st.button("Predict"):
        p = sv.predict(img)

        st.image(img.reshape(200, 200), caption="Uploaded Image", use_column_width=False, width=300)
        #st.write("Result:", dec[p[0]])
        st.write( f"<span style='font-size: 30px;'>{dec[p[0]]}</span>", unsafe_allow_html=True)


st.markdown("</div>", unsafe_allow_html=True)
