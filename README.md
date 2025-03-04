# TMTAL Projesi - Kart Okutma Sistemi

TMTAL, okul yönetimi ve öğrenci takibi için geliştirilmiş bir **kart okutma sistemidir**. Bu sistem sayesinde öğretmenler, öğrenci bilgilerini kolayca kaydedebilir, NFC kartlarını kullanarak öğrencilerin okul giriş ve çıkışlarını takip edebilirler.

## Özellikler

- **Öğretmen Hesabı**: Öğretmenler, sisteme giriş yaptıktan sonra öğrenci kaydı yapabilir, öğrencilerin kart bilgilerini kaydedebilir.
- **Öğrenci Kayıt Sistemi**: Öğrenciler, NFC kartları ile sisteme kaydedilir ve giriş/çıkış bilgileri otomatik olarak sisteme eklenir.
- **Okul Giriş/Çıkış Takibi**: Öğrencilerin okul giriş ve çıkış tarihleri otomatik olarak kaydedilir.
- **Dashboard**: Öğrencilerin ve öğretmenlerin bilgilerini görsel bir arayüzde takip edebilirsiniz.
- **Yetkilendirme Sistemleri**: Kullanıcı rolleri ( öğretmen, admin) belirlenerek farklı yetki seviyelerine sahip kullanıcıların sisteme giriş yapabilmesi sağlanır.
- **Gelişmiş Yönetim Paneli**: Okul yönetimi, öğrencilerin giriş/çıkış bilgilerini kolayca yönetebilir ve raporlar oluşturabilir.

## Kullanım

1. **Proje Kurulumu**: 
   - Projeyi yerel ortamda çalıştırmak için gerekli tüm bağımlılıkları yükleyin.
   - Gerekli veritabanı yapılandırmasını yapın.
   - NFC okuyucu ve kartları bağlayın.

2. **Kullanıcı Hesapları**:
   - **Öğretmen**: Öğretmenler, öğrenci eklemek, güncellemek ve izlemek için sisteme giriş yapabilir.
   - **Admin**: Sisteme yeni yöneticiler ve öğretmenleri ekleyebilirler.

3. **Kart Okutma**:
   - Öğrenciler, NFC kartlarını okutarak okul giriş/çıkış işlemlerini gerçekleştirebilirler.

## Kurulum ve Başlangıç

Projeyi bilgisayarınızda çalıştırmak için aşağıdaki adımları takip edebilirsiniz:

1. Bu repository'yi bilgisayarınıza klonlayın:

   ```bash
   git clone https://github.com/myheisenberg/tmtal.git
