import tensorflow as tf
import numpy as np
from matplotlib import pyplot as plt
import cv2
import math as m
import os
from csv import DictReader, writer


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
# img2 = cv2.imread('POSE/DATASET/TRAIN/goddess/00000000.jpg')
# img = tf.image.resize_with_pad(np.expand_dims(img2, axis=0), 192, 192)
# input_image = tf.cast(img, dtype=tf.float32)
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
# interpreter.set_tensor(input_details[0]['index'], np.array(input_image))
# interpreter.invoke()
# keypoints_with_scores = interpreter.get_tensor(output_details[0]['index'])
# print(keypoints_with_scores)
# print(img.shape)

# frame = img2.copy()
# frame = cv2.resize(frame, (192, 192))

# Rendering
# frame = img2.copy()
# frame = cv2.resize(frame, (192, 192))
# draw_connections(frame, keypoints_with_scores, EDGES, 0.0)
# draw_keypoints(frame, keypoints_with_scores, 0.0)
# webs = tree_angle(keypoints_with_scores)
# print(webs)
# cv2.imshow('MoveNet Lightning', frame)
# cv2.waitKey(0)
# cv2.destroyAllWindows()


# individual original pose angles
# directory = 'POSE/DATASET/TRAIN/warrior2'


# with open('POSE/compare/warrior.csv', 'w', newline='') as f_object:
#     # print("in open")
#     for filename in os.scandir(directory):
#         # print("in dir")
#         if filename.is_file():
#             # print(filename.path)
#             img2 = cv2.imread(filename.path)
#             img = tf.image.resize_with_pad(
#                 np.expand_dims(img2, axis=0), 192, 192)
#             input_image = tf.cast(img, dtype=tf.float32)

#             interpreter.set_tensor(
#                 input_details[0]['index'], np.array(input_image))
#             interpreter.invoke()
#             keypoints_with_scores = interpreter.get_tensor(
#                 output_details[0]['index'])

#             for a in range(len(keypoints_with_scores)):
#                 # print("in a")
#                 ke = keypoints_with_scores.copy()
#                 ke = ke[0][0]
#                 if ke[a][2] < 0.7:
#                     np.delete(ke, a)
#             if len(ke) == 17:
#                 # print("in")
#                 angles = tree_angle(keypoints_with_scores)

#                 writer_object = writer(f_object)
#                 writer_object.writerow(angles)
# f_object.close()


# all poses average angles
# directory = 'POSE/compare/'


# for filename in os.scandir(directory):
#     #         # print("in dir")
#     if filename.is_file():
#         with open(filename.path) as file:
#             lines = file.readlines()
#             rows_of_numbers = [map(float, line.split(',')) for line in lines]
#             sums = map(sum, zip(*rows_of_numbers))
#             averages = [sum_item / len(lines) for sum_item in sums]
#             print(averages)
#             with open('POSE/pose_angles.csv', 'a', newline='') as f:
#                 # print("in")
#                 writer1 = writer(f)
#                 fields = ['Butterfly', 'Goddess', 'Tree', 'Warrior']
#                 # print("before")
#                 writer1.writerow(fields)
#                 # print("after")
#                 for val in averages:
#                     writer1.writerow([val])

# angle-dict
dict_angles = {1: 'left forearm',
               2: 'right forearm',
               3: 'left arm',
               4: 'right arm',
               5: 'left thigh',
               6: 'right thigh',
               7: 'left shin',
               8: 'right shin'}


count = 0
# webcam keypoints
url1 = "Flask_App/videos/fall-01.mp4"
cap = cv2.VideoCapture(0)
while cap.isOpened():
    ret, frame = cap.read()
    count += 1
    if count > 10:
        angle_diff = []
        img = frame.copy()
        img = tf.image.resize_with_pad(np.expand_dims(img, axis=0), 192, 192)
        input_image = tf.cast(img, dtype=tf.float32)

        # Setup input and output
        input_details = interpreter.get_input_details()
        output_details = interpreter.get_output_details()

        # Make predictions
        interpreter.set_tensor(
            input_details[0]['index'], np.array(input_image))
        interpreter.invoke()
        keypoints_with_scores = interpreter.get_tensor(
            output_details[0]['index'])

        # Rendering
        draw_connections(frame, keypoints_with_scores, EDGES, 0.2)
        draw_keypoints(frame, keypoints_with_scores, 0.2)
        web_angles = []
        ke = keypoints_with_scores.copy()
        kz = ke[0][0]
        # print(kz)
        kx = []
        for a in range(17):
            # print("in a", kz[a][2])
            # ke = ke[ke[a][2] < 0.6]
            if kz[a][2] < 0.4:
                # print("in if")
                kx.append(a)
        knew = np.delete(kz, kx, axis=0)
        # kz.remove(a)
        # print(len(knew))
        if len(knew) == 17:
            # print("YES")
            # else:
            #     print(knew)
            #         # print("in")
            web_angles = tree_angle(keypoints_with_scores)
            # print(web_angles)

            filename = 'POSE/pose_angles.csv'
            pose_angles = []

            with open(filename, 'r') as file:
                filez = DictReader(file)
                for col in filez:
                    pose_angles.append(col['Warrior'])

            f = 0
            # print(pose_angles)
            for z in range(8):
                j = float(pose_angles[z])
                mn = float(web_angles[z])
                # print("pose=", type(j),
                #       " , web=", type(mn))

                angle_diff.append(abs(j-mn))
            max_angle = max(angle_diff)
            if max_angle > 25:

                print(angle_diff)
                ind = angle_diff.index(max_angle)
                print(ind)
                part = dict_angles[ind+1]
                if max_angle < (float(pose_angles[ind])-15):
                    print("Turn your ", part, "in a clockwise direction.")
                elif max_angle > (float(pose_angles[ind])+15):
                    print("Turn your ", part, "in a anticlockwise direction.")
                    # print(angle_diff)
            else:
                print("Pose done Correctly")

    # # pose-web
    # # negative toh clockwise
    # # positive toh anticlockwise

    # # make dictionary of angles
    # # make dictionary of correction
    # # output correction

    # # first ceck for full body in camera by checking 17 keypoints
    # # **********************************

    # # process after 10 frames
    # # for each correction, pick only maximum angle diff and give output
    # '''correction algo:
    # make angle diff array
    # pick max of angle_diff
    # compare to average range of pose
    # give correction
    # '''
        else:
            pass
    #         # print("keypoints not detected")

        cv2.imshow('MoveNet Lightning', frame)

        if cv2.waitKey(10) & 0xFF == ord('q'):
            break
        count = 0

cap.release()
cv2.destroyAllWindows()
