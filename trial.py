import numpy as np
import skimage.io
import cv2

def img2edges(imgFile, outFile):

    img = skimage.io.imread(imgFile, as_gray=False)

    kernel_size = (5, 5)
    img_blurred = img.copy() if kernel_size == (0,0) else cv2.GaussianBlur(img.copy(), kernel_size, 0)

    edges = np.max(np.array([edgedetect(img_blurred[:, :, 0]),
                             edgedetect(img_blurred[:, :, 1]),
                             edgedetect(img_blurred[:, :, 2])]), axis=0)  

 
    edges_zeroed = edges.copy()
    edges_zeroed[edges.copy() <= np.mean(edges.copy())] = 0 
    img_edges = edges_zeroed

    skimage.io.imsave(outFile, img_edges)

def edgedetect(channel):
    sobelX = cv2.Sobel(channel, cv2.CV_16S, 1, 0)
    sobelY = cv2.Sobel(channel, cv2.CV_16S, 0, 1)
    sobel = np.hypot(sobelX, sobelY)
    sobel[sobel > 255] = 255 
    return sobel