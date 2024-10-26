#!/usr/bin/env python3
#-- coding: utf-8 --

# This script will test for a closed door.
# Exits with exit code:
#   0: door open
#   1: door closed
#   2: error

import sys
import RPi.GPIO as GPIO
import time

# Constants
DOOR1_GPIO_PIN = 17
DOOR2_GPIO_PIN = 27
GPIO_HIGH_LOW_ACTIVE = GPIO.HIGH
EXITCODE_DOOR_OPEN = 0
EXITCODE_DOOR_CLOSED = 1
EXITCODE_ERROR = 2

# Map door index to GPIO pin.
doorIndex = sys.argv[1]
pin_gpio = 0
match doorIndex:
    case "1":
        pin_gpio = DOOR1_GPIO_PIN
    case "2":
        pin_gpio = DOOR2_GPIO_PIN
    case _:
        print(format("ERROR", doorIndex))
        sys.exit(EXITCODE_ERROR)


# Set-up.
GPIO.setmode(GPIO.BOARD) #Use Board numerotation mode
GPIO.setwarnings(False) #Disable warnings
GPIO.setup(pin_gpio, GPIO.IN)

# Double-check sensor (debouncing). Only if the same state is retained
# over a certain period, the state is considered stable and thus final.
# Consider closed state to be either on LOW or HIGH signal, predefined
# as constant.
doorClosedPrevious = GPIO.input(pin_gpio) == GPIO_HIGH_LOW_ACTIVE
time.sleep(0.25)
doorClosedCurrent = GPIO.input(pin_gpio) == GPIO_HIGH_LOW_ACTIVE
while doorClosedCurrent != doorClosedPrevious:
    time.sleep(0.25)
    doorClosedPrevious = doorClosedCurrent
    doorClosedCurrent = GPIO.input(pin_gpio) == GPIO_HIGH_LOW_ACTIVE

# Clean-up.
GPIO.cleanup()
if doorClosedCurrent == True:
    print(format("CLOSED", doorIndex))
    sys.exit(EXITCODE_DOOR_CLOSED)
else:
    print(format("OPEN", doorIndex))
    sys.exit(EXITCODE_DOOR_OPEN)