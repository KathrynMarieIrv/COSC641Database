import os
import time
import mysql.connector
import schedule
import logging
from datetime import datetime

# Database Credentials (AWS RDS MySQL)
DB_HOST = "cosc640.cri6ug8q8yo6.us-east-2.rds.amazonaws.com"
DB_USER = "admin"
DB_PASSWORD = "your_password"  # Replace with actual password
DB_NAME = "your_database"
BACKUP_DIR = "./backups/"

# Logging Setup
logging.basicConfig(
    filename="backup_maintenance.log",
    level=logging.INFO,
    format="%(asctime)s - %(levelname)s - %(message)s"
)


def backup_mysql():
    """Creates a MySQL database backup using mysqldump for AWS RDS."""
    try:
        if not os.path.exists(BACKUP_DIR):
            os.makedirs(BACKUP_DIR)

        timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
        backup_file = os.path.join(BACKUP_DIR, f"{DB_NAME}_{timestamp}.sql")

        command = f"mysqldump -h {DB_HOST} -u {DB_USER} -p{DB_PASSWORD} {DB_NAME} > {backup_file}"
        os.system(command)

        logging.info(f"MySQL Backup Completed: {backup_file}")
        print(f"✅ MySQL Backup Completed: {backup_file}")

    except Exception as e:
        logging.error(f"MySQL Backup Failed: {str(e)}")
        print(f"❌ MySQL Backup Failed: {str(e)}")


def restore_mysql(backup_file):
    """Restores MySQL database from a backup file."""
    try:
        command = f"mysql -h {DB_HOST} -u {DB_USER} -p{DB_PASSWORD} {DB_NAME} < {backup_file}"
        os.system(command)

        logging.info(f"MySQL Restore Completed from {backup_file}")
        print(f"✅ MySQL Restore Completed from {backup_file}")

    except Exception as e:
        logging.error(f"MySQL Restore Failed: {str(e)}")
        print(f"❌ MySQL Restore Failed: {str(e)}")


def optimize_mysql():
    """Optimizes all tables in the AWS RDS MySQL database."""
    try:
        connection = mysql.connector.connect(
            host=DB_HOST, user=DB_USER, password=DB_PASSWORD, database=DB_NAME
        )
        cursor = connection.cursor()
        cursor.execute("SHOW TABLES")
        tables = cursor.fetchall()

        for table in tables:
            cursor.execute(f"OPTIMIZE TABLE {table[0]};")
            print(f"🔄 Optimized {table[0]}")

        connection.commit()
        cursor.close()
        connection.close()
        logging.info("MySQL Optimization Completed")
        print("✅ MySQL Optimization Completed")

    except Exception as e:
        logging.error(f"MySQL Optimization Failed: {str(e)}")
        print(f"❌ MySQL Optimization Failed: {str(e)}")


def clean_old_records():
    """Deletes records older than 6 months from a specific table in AWS RDS."""
    try:
        connection = mysql.connector.connect(
            host=DB_HOST, user=DB_USER, password=DB_PASSWORD, database=DB_NAME
        )
        cursor = connection.cursor()
        
        cursor.execute("DELETE FROM logs WHERE timestamp < NOW() - INTERVAL 6 MONTH;")
        connection.commit()
        
        cursor.close()
        connection.close()
        logging.info("Old records cleaned up")
        print("✅ Old records cleaned up.")

    except Exception as e:
        logging.error(f"Cleanup Failed: {str(e)}")
        print(f"❌ Cleanup Failed: {str(e)}")


def run_maintenance():
    """Runs all maintenance tasks."""
    print("\n🔧 Running Full Maintenance Task...")
    logging.info("Starting Full Maintenance Task")
    optimize_mysql()
    clean_old_records()
    print("✅ Maintenance Completed!\n")
    logging.info("Maintenance Completed")


# **Schedule Tasks Automatically**
schedule.every().day.at("00:00").do(backup_mysql)  # Backup at Midnight
schedule.every().sunday.at("03:00").do(run_maintenance)  # Optimize & Cleanup on Sundays

print("⏳ Scheduled tasks are running... Press Ctrl+C to stop.")

# **Keep Running to Process Scheduled Tasks**
while True:
    schedule.run_pending()
    time.sleep(60)  # Check every minute
