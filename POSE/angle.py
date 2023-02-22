import tensorflow as tf
import numpy as np
from matplotlib import pyplot as plt
import cv2
import math as m


def draw_keypoints(frame, keypoints, confidence_threshold):
    y, x, c = frame.shape
    shaped = np.squeeze(np.multiply(keypoints, [y, x, 1]))

    for kp in shaped:
        ky, kx, kp_conf = kp
        if kp_conf > confidence_threshold:
            cv2.circle(frame, (int(kx), int(ky)), 4, (0, 255, 0), -1)


def draw_connections(frame, keypoints, edges, confidence_threshold):
    y, x, c = frame.shape
    shaped = np.squeeze(np.multiply(keypoints, [y, x, 1]))

    for edge, color in edges.items():
        p1, p2 = edge
        y1, x1, c1 = shaped[p1]
        y2, x2, c2 = shaped[p2]

        if (c1 > confidence_threshold) & (c2 > confidence_threshold):
            cv2.line(frame, (int(x1), int(y1)),
                     (int(x2), int(y2)), (0, 0, 255), 2)


# angles
def tree_angle(frame, keypoints):
    left_knee = keypoints[0][0][7]
    left_ankle = keypoints[0][0][9]
    x1 = left_knee[0]*192
    x2 = left_ankle[0]*192
    y2 = left_ankle[1]*192
    y1 = left_knee[1]*192
    # cos = (x2-x1)/(m.sqrt(((x2-x1)**2)+((y2-y1)**2)))
    tan = (y2-y1)/(x2-x1)
    a = m.degrees(m.atan(tan))
    print(a)
    cv2.line(frame, (int(x1), int(y1)),
             (int(x2), int(y2)), (0, 0, 255), 2)
    cv2.imshow('MoveNet Lightning', frame)
    cv2.waitKey(0)
    cv2.destroyAllWindows()


interpreter = tf.lite.Interpreter(
    model_path='POSE/lite-model_movenet_singlepose_lightning_3.tflite')
interpreter.allocate_tensors()
img2 = cv2.imread('POSE/DATASET/TRAIN/tree/00000082.jpg')
img = tf.image.resize_with_pad(np.expand_dims(img2, axis=0), 192, 192)
input_image = tf.cast(img, dtype=tf.float32)
# cv2.imshow('Image', img)
# cv2.waitKey(0)
# cv2.destroyAllWindows()

EDGES = {
    (0, 1): 'm',
    (0, 2): 'c',
    (1, 3): 'm',
    (2, 4): 'c',
    (0, 5): 'm',
    (0, 6): 'c',
    (5, 7): 'm',
    (7, 9): 'm',
    (6, 8): 'c',
    (8, 10): 'c',
    (5, 6): 'y',
    (5, 11): 'm',
    (6, 12): 'c',
    (11, 12): 'y',
    (11, 13): 'm',
    (13, 15): 'm',
    (12, 14): 'c',
    (14, 16): 'c'
}

# Setup input and output
input_details = interpreter.get_input_details()
output_details = interpreter.get_output_details()

# Make predictions
interpreter.set_tensor(input_details[0]['index'], np.array(input_image))
interpreter.invoke()
keypoints_with_scores = interpreter.get_tensor(output_details[0]['index'])
print(keypoints_with_scores)
print(img.shape)

frame = img2.copy()
frame = cv2.resize(frame, (192, 192))
tree_angle(frame, keypoints_with_scores)
# Rendering
# frame = img2.copy()
# frame = cv2.resize(frame, (192, 192))
# draw_connections(frame, keypoints_with_scores, EDGES, 0.0)
# draw_keypoints(frame, keypoints_with_scores, 0.0)

# cv2.imshow('MoveNet Lightning', frame)
# cv2.waitKey(0)
# cv2.destroyAllWindows()
