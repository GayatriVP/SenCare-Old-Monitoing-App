import tensorflow as tf
import numpy as np
from matplotlib import pyplot as plt
import cv2


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
def tree_angle(keypoints):
    # print("[", keypoints[0][0][5], ",",  keypoints[0][0][6],
    #       ",", keypoints[0][0][9], ",", keypoints[0][0][10])
    # print("HEllo")
    edg = keypoints[0][0].copy()
    # print(edg)
    # print(len(edg))

    # temp1 = edg[9]
    edg[9] = keypoints[0][0][5]
    edg[5] = keypoints[0][0][9]

    # print("[", keypoints[0][0][5], ",",  keypoints[0][0][6],
    #       ",", keypoints[0][0][9], ",", keypoints[0][0][10])

    # temp2 = edg[10]
    edg[10] = keypoints[0][0][6]
    edg[6] = keypoints[0][0][10]

    # print("[", edg[5], ",", edg[6], ",", edg[9], ",", edg[10])
    angles = []
    for i in range(5, 13):
        # First coord
        a = np.array([edg[i][0], edg[i][1]])
        # Second coord
        b = np.array([edg[i+2][0], edg[i+2][1]])
        # Third coord
        c = np.array([edg[i+4][0], edg[i+4][1]])
        radians = np.arctan2(c[1] - b[1], c[0]-b[0]) - \
            np.arctan2(a[1]-b[1], a[0]-b[0])
        angle = np.abs(radians*180.0/np.pi)

        if angle > 180.0:
            angle = 360-angle
        angles.append(angle)
    # print(angles)
    return angles
    # cv2.line(frame, (int(x1), int(y1)),
    #          (int(x2), int(y2)), (0, 0, 255), 2)
    # cv2.imshow('MoveNet Lightning', frame)
    # cv2.waitKey(0)
    # cv2.destroyAllWindows()


interpreter = tf.lite.Interpreter(
    model_path='POSE/lite-model_movenet_singlepose_lightning_3.tflite')
interpreter.allocate_tensors()
img2 = cv2.imread('POSE/DATASET/TRAIN/butterfly/2. image0101.png')
img = tf.image.resize_with_pad(np.expand_dims(img2, axis=0), 192, 192)
input_image = tf.cast(img, dtype=tf.float32)

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
# print(keypoints_with_scores)
# print(img.shape)

frame = img2.copy()
frame = cv2.resize(frame, (192, 192))

# Rendering
frame = img2.copy()
frame = cv2.resize(frame, (192, 192))
draw_connections(frame, keypoints_with_scores, EDGES, 0.0)
draw_keypoints(frame, keypoints_with_scores, 0.0)
webs = tree_angle(keypoints_with_scores)
print(webs)
cv2.imshow('MoveNet Lightning', frame)
cv2.waitKey(0)
cv2.destroyAllWindows()
