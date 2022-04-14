import cv2
import sys


# Importing Image module from PIL package
from PIL import Image
import PIL




# Load the cascade
face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
eye_cascade = cv2.CascadeClassifier('haarcascade_eye.xml')
smile_cascade = cv2.CascadeClassifier('haarcascade_smile.xml')

#faces  = face_cascade.detectMultiScale(gray, 1.3, 5)


def detect(gray, image):
    faces = face_cascade.detectMultiScale(gray, 1.3, 5)
    for (x, y, w, h) in faces:
        cv2.rectangle(image, (x, y), ((x + w), (y + h)), (255, 0, 0), 2)
        roi_gray = gray[y:y + h, x:x + w]
        roi_color = image[y:y + h, x:x + w]
        smiles = smile_cascade.detectMultiScale(roi_gray, 1.8, 20)

        for (sx, sy, sw, sh) in smiles:
            cv2.rectangle(roi_color, (sx, sy), ((sx + sw), (sy + sh)), (0, 0, 255), 2)
    return image

pic = sys.argv[1]

image = cv2.imread( pic )


# To capture image in monochrome
gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

# calls the detect() function
canvas = detect(gray, image)




# creating a image object (main image)


cv2.imwrite(pic,canvas)
# save a image using extension

# Release the capture once all the processing is done.


