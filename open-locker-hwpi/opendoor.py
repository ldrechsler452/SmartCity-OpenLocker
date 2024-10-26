#!/usr/bin/env python3
#-- coding: utf-8 --

# This script will release a door lock.

import sys
import RPi.GPIO as GPIO
import time

# Constants.
DOOR1_GPIO_PIN = 12
DOOR2_GPIO_PIN = 13
SERVO_LEFT_DUTYCYCLE = 0.02
SERVO_RIGHT_DUTYCYCLE = 0.13
SERVO_DURATION = 3
EXITCODE_OK = 0
EXITCODE_ERROR = 2

# Map door index to GPIO pin.
doorIndex = sys.argv[1]
pwm_gpio = 0
match doorIndex:
    case "1":
        pwm_gpio = DOOR1_GPIO_PIN
    case "2":
        pwm_gpio = DOOR2_GPIO_PIN
    case _:
        sys.exit(EXITCODE_ERROR)


# Set-up.
GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)
frequence = 50
GPIO.setup(pwm_gpio, GPIO.OUT)
pwm = GPIO.PWM(pwm_gpio, frequence)

# Release door lock.
pwm.start(SERVO_RIGHT_DUTYCYCLE)
time.sleep(SERVO_DURATION)

# Reset door lock.
pwm.ChangeDutyCycle(SERVO_LEFT_DUTYCYCLE)
time.sleep(SERVO_DURATION)

# Clean-up.
pwm.stop()
GPIO.cleanup()
sys.exit(EXITCODE_OK)