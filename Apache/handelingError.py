import datetime

now = datetime.datetime.now()
now = now.strftime("%Y-%m-%d %H:%M:%S")

with open('./log_error.txt', 'a') as out:
    out.write(f'Error - {now}\n')
