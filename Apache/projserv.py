import datetime
import time
import sys

def get_current_datetime():
    now = datetime.datetime.now()
    return now.strftime("%Y-%m-%d %H:%M:%S")

now = get_current_datetime()
with open('./log_prog.txt', 'a') as out:
    out.write(f'STARTING Prog service - {now}\n')

while(True):
    time.sleep(10)
    now = get_current_datetime()
    with open('./log_prog.txt', 'a') as out:
        out.write(f'Prog - {now}\n')
    break
sys.exit(1)
