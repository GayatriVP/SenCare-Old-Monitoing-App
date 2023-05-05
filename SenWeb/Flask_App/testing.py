import pandas as pd
import os
import csv
import re
import detect_ellipse
numbers = re.compile(r'(\d+)')


def numericalSort(value):
    parts = numbers.split(value)
    parts[1::2] = map(int, parts[1::2])
    return parts


# i = 410
path = "C:/xampp/htdocs/SenWeb/Flask_App/Dataset/Videos/"
# for filename in os.listdir(path):
#     my_dest = "vid" + str(i) + ".mp4"
#     my_source = path + filename
#     my_dest = path + my_dest
#     # rename() function will
#     # rename all the files
#     os.rename(my_source, my_dest)
#     i += 1

# name of csv file
filename = "matrix.csv"

# # # getting list of files from directory
# for folder_path, folders, files in os.walk(path):
#     fi = files
# fi.sort()
# print(sorted(files, key=numericalSort))

# zi = sorted(files, key=numericalSort)

# fields = ['videos', 'label', 'prediction']
# # writing to csv file
# with open(filename, 'w', newline='') as csvfile:
#     # creating a csv writer object
#     csvwriter = csv.writer(csvfile)

#     # writing the fields
#     csvwriter.writerow(fields)

#     for val in zi:
#         csvwriter.writerow(([val]))

# writing the data rows
# csvwriter.writerows(fi)
li = []
for i in range(3):
    url = "Flask_App/Dataset/Videos/vid"+str(i)+".avi"
    print(url)
    pred = detect_ellipse.predict(url)
    li.append(pred)

# with open('outp.csv', mode='w', newline='') as file:
#     writer = csv.writer(file)
#     # writer.writerow(['Name', 'Age', 'Gender', 'New Column']) # Add header for the new column
#     with open('matrix.csv', mode='r') as old_file:
#         reader = csv.reader(old_file)
#         m = 0
#         next(reader, None)  # skip header row
#         for row in reader:
#             # manipulate data as needed to generate values for the new column
#             # new_value = 'some_value'
#             row.append(li[m])  # add the new value to the row
#             writer.writerow(row)
#             m += 1
