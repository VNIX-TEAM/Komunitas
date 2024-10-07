import json
import logging
from telegram import Update
from telegram.ext import ApplicationBuilder, ContextTypes, MessageHandler, filters

# Konfigurasi logging
logging.basicConfig(
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    level=logging.INFO
)

# Baca konfigurasi dari file JSON
def load_config():
    with open('details.json', 'r') as file:
        return json.load(file)

config = load_config()
BOT_TOKEN = config['bot_token']
TARGET_GROUP_ID = config['group_id']

# Fungsi untuk menangani pesan selamat datang
async def welcome(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    if update.message.chat_id != TARGET_GROUP_ID:
        return

    if update.message.new_chat_members:
        for new_member in update.message.new_chat_members:
            welcome_message = (
                f"Selamat datang {new_member.mention_html()} menjadi Keluarga Besar Victory8et\n"
                "Dapatkan Promo Menarik Setiap Harinya\n"
                "~DEPOSIT KILAT WD PUN CEPAT~\n"
                "- LINK UTAMA : bit.ly/victory8et\n"
                "- LINK ALTERNATIF : bit.ly/victory8et01\n"
                "- LINK RTP : bit.ly/rtpvictory8et\n"
                "ADMIN HANYA : @Victory8etOfficial"
            )
            
            await update.message.reply_html(welcome_message)

def main() -> None:
    application = ApplicationBuilder().token(BOT_TOKEN).build()
    
    application.add_handler(MessageHandler(filters.StatusUpdate.NEW_CHAT_MEMBERS, welcome))
    
    application.run_polling()

if __name__ == '__main__':
    main()