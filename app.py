import streamlit as st
from keras.models import load_model
import numpy as np
from PIL import Image

# Load the saved model
model = load_model("C:/Users/User/Desktop/savedmodel/eyemodel.h5")

# Streamlit app
st.title("Eye Cancer Detection App")

# Upload image through Streamlit
uploaded_file = st.file_uploader("Choose an image...", type=["jpg", "png", "jpeg"])

if uploaded_file is not None:
    # Preprocess the image
    img = Image.open(uploaded_file)
    img = img.resize((224, 224))  # Adjust to your model's input shape
    img_array = np.array(img) / 255.0  # Normalize pixel values

    # Make predictions
    prediction = model.predict(np.expand_dims(img_array, axis=0))

    # Display results
    st.image(img, caption="Uploaded Image", use_column_width=True)
    st.write("Class Predictions:")
    st.write(prediction)
