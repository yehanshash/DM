# Use the official Python image as base
FROM python:3

# Set the working directory in the container
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install required dependencies
RUN pip install flask scikit-learn xgboost pandas numpy

# Expose the Flask port
EXPOSE 5000

# Command to run the application
CMD ["python", "home.py"]
