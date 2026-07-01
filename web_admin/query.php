<?php
class crud extends koneksi {
    public function login($data){
        $sql ="SELECT * FROM administrator WHERE email=:email";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":email", $data);
        $result->execute();
        return $result;
    }

    public function ValidasiEmail($data){
        $sql ="SELECT * FROM administrator WHERE email=:email";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":email", $data);
        $result->execute();
        return $result;
    }
    
    // lihat
    public function lihatLevel(){
        $sql = "SELECT * FROM level";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatAdministrator(){
        $sql = "SELECT * FROM administrator JOIN level ON administrator.id_level=level.id_level JOIN terminal ON administrator.id_terminal=terminal.id_terminal";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatUser(){
        $sql = "SELECT * FROM user";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatBus(){
        $sql = "SELECT id_bus, foto_bus, nama_bus, harga, status_bus, jumlah_kursi, tanggal_pemberangkatan, jenis, fasilitas, u1.nama_terminal pemberangkatan, u2.nama_terminal tujuan, waktu_berangkat, waktu_tiba FROM bus JOIN jenis_bus ON bus.id_jenis=jenis_bus.id_jenis JOIN rute ON bus.id_rute=rute.id_rute JOIN terminal u1 ON rute.pemberangkatan=u1.id_terminal JOIN terminal u2 ON rute.tujuan=u2.id_terminal ORDER BY bus.id_bus ASC";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatTerminal(){
        $sql = "SELECT * FROM terminal";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatJenisBus(){
        $sql = "SELECT * FROM jenis_bus";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatRute(){
        $sql = "SELECT id_rute, u1.nama_terminal pemberangkatan, u2.nama_terminal tujuan, waktu_berangkat, waktu_tiba FROM rute JOIN terminal u1 ON rute.pemberangkatan=u1.id_terminal JOIN terminal u2 ON rute.tujuan=u2.id_terminal ORDER BY rute.id_rute ASC";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatPenumpang(){
        $sql = "SELECT * FROM penumpang";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatPemesanan(){
        $sql = "SELECT * FROM tiket JOIN pemesanan ON tiket.id_pemesanan=pemesanan.id_pemesanan JOIN penumpang ON tiket.nik_penumpang=penumpang.nik_penumpang JOIN user ON pemesanan.nik_user=user.nik_user JOIN bus ON pemesanan.id_bus=bus.id_bus";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatLaporan($tanggal_mulai, $tanggal_selesai){
        $sql = "SELECT * FROM tiket JOIN pemesanan ON tiket.id_pemesanan=pemesanan.id_pemesanan JOIN penumpang ON tiket.nik_penumpang=penumpang.nik_penumpang JOIN user ON pemesanan.nik_user=user.nik_user JOIN bus ON pemesanan.id_bus=bus.id_bus WHERE waktu_pemesanan BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatTiket(){
        $sql = "SELECT * FROM tiket";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatPembayaran(){
        $sql = "SELECT * FROM pembayaran";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    // insert
    public function insertAdministrator($nama, $jenis_kelamin, $alamat, $no_hp, $foto, $level, $id_terminal, $email, $password){
        try{
            $sql ="INSERT INTO administrator(nama, jenis_kelamin, alamat, no_hp, foto, id_level, id_terminal, email, password) VALUES (:nama, :jenis_kelamin, :alamat, :no_hp, :foto, :id_level, :id_terminal, :email, :password)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama", $nama);
            $result->bindParam(":jenis_kelamin", $jenis_kelamin);
            $result->bindParam(":alamat", $alamat);
            $result->bindParam(":no_hp", $no_hp);
            $result->bindParam(":foto", $foto);
            $result->bindParam(":id_level", $level);
            $result->bindParam(":id_terminal", $id_terminal);
            $result->bindParam(":email", $email);
            $result->bindParam(":password", $password);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertAdministrato($nama, $jenis_kelamin, $alamat, $no_hp, $level, $id_terminal, $email, $password){
        try{
            $sql ="INSERT INTO administrator(nama, jenis_kelamin, alamat, no_hp, id_level, id_terminal, email, password) VALUES (:nama, :jenis_kelamin, :alamat, :no_hp, :id_level, :id_terminal, :email, :password)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama", $nama);
            $result->bindParam(":jenis_kelamin", $jenis_kelamin);
            $result->bindParam(":alamat", $alamat);
            $result->bindParam(":no_hp", $no_hp);
            $result->bindParam(":id_level", $level);
            $result->bindParam(":id_terminal", $id_terminal);
            $result->bindParam(":email", $email);
            $result->bindParam(":password", $password);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertUser($nik_user, $nama_user, $tempat_lahir_user, $tanggal_lahir_user, $jenis_kelamin_user, $alamat_user, $no_hp_user, $foto_user, $email_user, $password_user){
        try{
            $sql ="INSERT INTO user(nik_user, nama_user, tempat_lahir_user, tanggal_lahir_user, jenis_kelamin_user, alamat_user, no_hp_user, foto_user, email_user, password_user) VALUES (:nik_user, :nama_user, :tempat_lahir_user, :tanggal_lahir_user, :jenis_kelamin_user, :alamat_user, :no_hp_user, :foto_user, :email_user, :password_user)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nik_user", $nik_user);
            $result->bindParam(":nama_user", $nama_user);
            $result->bindParam(":tempat_lahir_user", $tempat_lahir_user);
            $result->bindParam(":tanggal_lahir_user", $tanggal_lahir_user);
            $result->bindParam(":jenis_kelamin_user", $jenis_kelamin_user);
            $result->bindParam(":alamat_user", $alamat_user);
            $result->bindParam(":no_hp_user", $no_hp_user);
            $result->bindParam(":foto_user", $foto_user);
            $result->bindParam(":email_user", $email_user);
            $result->bindParam(":password_user", $password_user);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertBus($nama_bus, $harga, $status_bus, $jumlah_kursi, $foto_bus, $tanggal_pemberangkatan, $id_jenis, $id_rute){
        try{
            $sql ="INSERT INTO bus(nama_bus, harga, status_bus, jumlah_kursi, foto_bus, tanggal_pemberangkatan, id_jenis, id_rute) VALUES (:nama_bus, :harga, :status_bus, :jumlah_kursi, :foto_bus, :tanggal_pemberangkatan, :id_jenis, :id_rute)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama_bus", $nama_bus);
            $result->bindParam(":harga", $harga);
            $result->bindParam(":status_bus", $status_bus);
            $result->bindParam(":jumlah_kursi", $jumlah_kursi);
            $result->bindParam(":foto_bus", $foto_bus);
            $result->bindParam(":tanggal_pemberangkatan", $tanggal_pemberangkatan);
            $result->bindParam(":id_jenis", $id_jenis);
            $result->bindParam(":id_rute", $id_rute);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertTerminal($nama_terminal, $alamat_terminal, $provinsi, $kabupaten, $kecamatan){
        try{
            $sql ="INSERT INTO terminal(nama_terminal, detail_alamat_terminal, provinsi_terminal, kabupaten_terminal, kecamatan_terminal) VALUES (:terminal, :alamat, :provinsi, :kabupaten, :kecamatan)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":terminal", $nama_terminal);
            $result->bindParam(":alamat", $alamat_terminal);
            $result->bindParam(":provinsi", $provinsi);
            $result->bindParam(":kabupaten", $kabupaten);
            $result->bindParam(":kecamatan", $kecamatan);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertJenisBus($jenis, $fasilitas){
        try{
            $sql ="INSERT INTO jenis_bus(jenis, fasilitas) VALUES (:jenis, :fasilitas)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":jenis", $jenis);
            $result->bindParam(":fasilitas", $fasilitas);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertRute($pemberangkatan, $waktu_berangkat, $tujuan, $waktu_tiba){
        try{
            $sql ="INSERT INTO rute(pemberangkatan, waktu_berangkat, tujuan, waktu_tiba) VALUES (:pemberangkatan, :waktu_berangkat, :tujuan, :waktu_tiba)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":pemberangkatan", $pemberangkatan);
            $result->bindParam(":waktu_berangkat", $waktu_berangkat);
            $result->bindParam(":tujuan", $tujuan);
            $result->bindParam(":waktu_tiba", $waktu_tiba);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertPenumpang($nik_penumpang, $nama_penumpang, $jenis_kelamin_penumpang, $no_hp_penumpang){
        try{
            $sql ="INSERT INTO penumpang(nik_penumpang, nama_penumpang, jenis_kelamin_penumpang, no_hp_penumpang) VALUES (:nik_penumpang, :nama_penumpang, :jenis_kelamin_penumpang, :no_hp_penumpang)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nik_penumpang", $nik_penumpang);
            $result->bindParam(":nama_penumpang", $nama_penumpang);
            $result->bindParam(":jenis_kelamin_penumpang", $jenis_kelamin_penumpang);
            $result->bindParam(":no_hp_penumpang", $no_hp_penumpang);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertPemesanan($nik_user, $nik_penumpang, $waktu_pemesanan, $total_bayar){
        try{
            $sql ="INSERT INTO pemesanan(nik_user, nik_penumpang, waktu_pemesanan, total_bayar) VALUES (:nik_user, :nik_penumpang, :waktu_pemesanan, :total_bayar)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nik_user", $nik_user);
            $result->bindParam(":nik_penumpang", $nik_penumpang);
            $result->bindParam(":waktu_pemesanan", $waktu_pemesanan);
            $result->bindParam(":total_bayar", $total_bayar);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function insertTiket($id_tiket, $id_bus, $jumlah_kursi_pesan){
        try{
            $sql ="INSERT INTO detail_pemesanan(id_pemesanan, id_bus, jumlah_kursi_pesan) VALUES (:id_pemesanan, :id_bus, :jumlah_kursi_pesan)";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_pemesanan", $id_pemesanan);
            $result->bindParam(":id_bus", $id_bus);
            $result->bindParam(":jumlah_kursi_pesan", $jumlah_kursi_pesan);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    // detail
    public function detailAdministrator($data){
        try{
            $sql ="SELECT * FROM administrator WHERE id_user_admin=:id_user_admin";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_user_admin", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_user_admin);
            $result->bindColumn(2, $this->nama);
            $result->bindColumn(3, $this->jenis_kelamin);
            $result->bindColumn(4, $this->alamat);
            $result->bindColumn(5, $this->no_hp);
            $result->bindColumn(6, $this->foto);
            $result->bindColumn(7, $this->id_level);
            $result->bindColumn(8, $this->id_terminal);
            $result->bindColumn(9, $this->email);
            $result->bindColumn(10, $this->password);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailUser($data){
        try{
            $sql ="SELECT * FROM user WHERE nik_user=:nik_user";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nik_user", $data);
            $result->execute();
            $result->bindColumn(1, $this->nik_user);
            $result->bindColumn(2, $this->nama_user);
            $result->bindColumn(3, $this->tempat_lahir_user);
            $result->bindColumn(4, $this->tanggal_lahir_user);
            $result->bindColumn(5, $this->jenis_kelamin_user);
            $result->bindColumn(6, $this->alamat_user);
            $result->bindColumn(7, $this->no_hp_user);
            $result->bindColumn(8, $this->foto_user);
            $result->bindColumn(9, $this->email_user);
            $result->bindColumn(10, $this->password_user);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailBus($data){
        try{
            $sql ="SELECT * FROM bus WHERE id_bus=:id_bus";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_bus", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_bus);
            $result->bindColumn(2, $this->nama_bus);
            $result->bindColumn(3, $this->harga);
            $result->bindColumn(4, $this->status_bus);
            $result->bindColumn(5, $this->jumlah_kursi);
            $result->bindColumn(6, $this->foto_bus);
            $result->bindColumn(7, $this->tanggal_pemberangkatan);
            $result->bindColumn(8, $this->id_jenis);
            $result->bindColumn(9, $this->id_rute);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailTerminal($data){
        try{
            $sql ="SELECT * FROM terminal WHERE id_terminal=:id_terminal";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_terminal", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_terminal);
            $result->bindColumn(2, $this->nama_terminal);
            $result->bindColumn(3, $this->detail_alamat_terminal);
            $result->bindColumn(4, $this->provinsi_terminal);
            $result->bindColumn(5, $this->kabupaten_terminal);
            $result->bindColumn(6, $this->kecamatan_terminal);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailJenisBus($data){
        try{
            $sql ="SELECT * FROM jenis_bus WHERE id_jenis=:id_jenis";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_jenis", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_jenis);
            $result->bindColumn(2, $this->jenis);
            $result->bindColumn(3, $this->fasilitas);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailRute($data){
        try{
            $sql ="SELECT * FROM rute WHERE id_rute=:id_rute";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_rute", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_rute);
            $result->bindColumn(2, $this->pemberangkatan);
            $result->bindColumn(3, $this->waktu_berangkat);
            $result->bindColumn(4, $this->tujuan);
            $result->bindColumn(5, $this->waktu_tiba);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailPenumpang($data){
        try{
            $sql ="SELECT * FROM penumpang WHERE nik_penumpang=:nik_penumpang";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nik_penumpang", $data);
            $result->execute();
            $result->bindColumn(1, $this->nik_penumpang);
            $result->bindColumn(2, $this->nama_penumpang);
            $result->bindColumn(3, $this->jenis_kelamin_penumpang);
            $result->bindColumn(4, $this->no_hp_penumpang);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailPemesanan($data){
        try{
            $sql ="SELECT * FROM pemesanan WHERE id_pemesanan=:id_pemesanan";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_pemesanan", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_pemesanan);
            $result->bindColumn(2, $this->nik_user);
            $result->bindColumn(3, $this->nik_penumpang);
            $result->bindColumn(4, $this->waktu_pemesanan);
            $result->bindColumn(5, $this->total_bayar);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function detailTiket($data){
        try{
            $sql ="SELECT * FROM tiket WHERE id_tiket=:id_tiket";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_tiket", $data);
            $result->execute();
            $result->bindColumn(1, $this->id_tiket);
            $result->bindColumn(2, $this->id_pemesanan);
            $result->bindColumn(3, $this->nik_penumpang);
            $result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()==1):
                return true;
            else:
                return false;
            endif;    
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    // pilih
    public function pilihAdministrator($data){
        $sql ="SELECT * FROM administrator WHERE id_user_admin=:id_user_admin";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_user_admin", $data);
        $result->execute();
        return $result;
    }

    public function pilihUser($data){
        $sql ="SELECT * FROM user WHERE nik_user=:nik_user";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":nik_user", $data);
        $result->execute();
        return $result;
    }

    public function pilihBus($data){
        $sql ="SELECT * FROM bus WHERE id_bus=:id_bus";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_bus", $data);
        $result->execute();
        return $result;
    }

    public function pilihTerminal($data){
        $sql ="SELECT * FROM terminal WHERE id_terminal=:id_terminal";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_terminal", $data);
        $result->execute();
        return $result;
    }

    public function pilihJenisBus($data){
        $sql ="SELECT * FROM jenis_bus WHERE id_jenis=:id_jenis";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_jenis", $data);
        $result->execute();
        return $result;
    }

    public function pilihRute($data){
        $sql ="SELECT * FROM rute WHERE id_rute=:id_rute";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_rute", $data);
        $result->execute();
        return $result;
    }

    public function pilihPenumpang($data){
        $sql ="SELECT * FROM penumpang WHERE nik_penumpang=:nik_penumpang";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":nik_penumpang", $data);
        $result->execute();
        return $result;
    }

    public function pilihPemesanan($data){
        $sql ="SELECT * FROM pemesanan WHERE id_pemesanan=:id_pemesanan";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_pemesanan", $data);
        $result->execute();
        return $result;
    }

    public function pilihTiket($data){
        $sql ="SELECT * FROM tiket WHERE id_tiket=:id_tiket";
        $result = $this->koneksi->prepare($sql);
        $result->bindParam(":id_tiket", $data);
        $result->execute();
        return $result;
    }

    // update
    public function updateAdministrator($nama, $jenis_kelamin, $alamat, $no_hp, $foto, $id_level, $id_terminal, $email, $password, $data){
        try{
            $sql ="UPDATE administrator SET nama=:nama, jenis_kelamin=:jenis_kelamin, alamat=:alamat, no_hp=:no_hp, foto=:foto, id_level=:id_level, id_terminal=:id_terminal, email=:email, password=:password WHERE id_user_admin=:id_user_admin";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama", $nama);
            $result->bindParam(":jenis_kelamin", $jenis_kelamin);
            $result->bindParam(":alamat", $alamat);
            $result->bindParam(":no_hp", $no_hp);
            $result->bindParam(":foto", $foto);
            $result->bindParam(":id_level", $id_level);
            $result->bindParam(":id_terminal", $id_terminal);
            $result->bindParam(":email", $email);
            $result->bindParam(":password", $password);
            $result->bindParam(":id_user_admin", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateUser($nama_user, $tempat_lahir_user, $tanggal_lahir_user, $jenis_kelamin_user, $alamat_user, $no_hp_user, $foto_user, $email_user, $password_user, $data){
        try{
            $sql ="UPDATE user SET nama_user=:nama_user, tempat_lahir_user=:tempat_lahir_user, tanggal_lahir_user=:tanggal_lahir_user, jenis_kelamin_user=:jenis_kelamin_user, alamat_user=:alamat_user, no_hp_user=:no_hp_user, foto_user=:foto_user, email_user=:email_user, password_user=:password_user WHERE nik_user=:nik_user";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama_user", $nama_user);
            $result->bindParam(":tempat_lahir_user", $tempat_lahir_user);
            $result->bindParam(":tanggal_lahir_user", $tanggal_lahir_user);
            $result->bindParam(":jenis_kelamin_user", $jenis_kelamin_user);
            $result->bindParam(":alamat_user", $alamat_user);
            $result->bindParam(":no_hp_user", $no_hp_user);
            $result->bindParam(":foto_user", $foto_user);
            $result->bindParam(":email_user", $email_user);
            $result->bindParam(":password_user", $password_user);
            $result->bindParam(":nik_user", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateBus($nama_bus, $harga, $status_bus, $jumlah_kursi, $foto_bus, $tanggal_pemberangkatan, $id_jenis, $id_rute, $data){
        try{
            $sql ="UPDATE bus SET nama_bus=:nama_bus, harga=:harga, status_bus=:status_bus, jumlah_kursi=:jumlah_kursi, foto_bus=:foto_bus, tanggal_pemberangkatan=:tanggal_pemberangkatan, id_jenis=:id_jenis, id_rute=:id_rute WHERE id_bus=:id_bus";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama_bus", $nama_bus);
            $result->bindParam(":harga", $harga);
            $result->bindParam(":status_bus", $status_bus);
            $result->bindParam(":jumlah_kursi", $jumlah_kursi);
            $result->bindParam(":foto_bus", $foto_bus);
            $result->bindParam(":tanggal_pemberangkatan", $tanggal_pemberangkatan);
            $result->bindParam(":id_jenis", $id_jenis);
            $result->bindParam(":id_rute", $id_rute);
            $result->bindParam(":id_bus", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTerminal($terminal, $alamat, $provinsi, $kabupaten, $kecamatan, $data){
        try{
            $sql ="UPDATE terminal SET nama_terminal=:terminal, detail_alamat_terminal=:alamat, provinsi_terminal=:provinsi, kabupaten_terminal=:kabupaten, kecamatan_terminal=:kecamatan WHERE id_terminal=:id_terminal";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":terminal", $terminal);
            $result->bindParam(":alamat", $alamat);
            $result->bindParam(":provinsi", $provinsi);
            $result->bindParam(":kabupaten", $kabupaten);
            $result->bindParam(":kecamatan", $kecamatan);
            $result->bindParam(":id_terminal", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateJenisBus($jenis, $fasilitas, $data){
        try{
            $sql ="UPDATE jenis_bus SET jenis=:jenis, fasilitas=:fasilitas WHERE id_jenis=:id_jenis";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":jenis", $jenis);
            $result->bindParam(":fasilitas", $fasilitas);
            $result->bindParam(":id_jenis", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateRute($pemberangkatan, $waktu_berangkat, $tujuan, $waktu_tiba, $data){
        try{
            $sql ="UPDATE rute SET pemberangkatan=:pemberangkatan, waktu_berangkat=:waktu_berangkat, tujuan=:tujuan, waktu_tiba=:waktu_tiba WHERE id_rute=:id_rute";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":pemberangkatan", $pemberangkatan);
            $result->bindParam(":waktu_berangkat", $waktu_berangkat);
            $result->bindParam(":tujuan", $tujuan);
            $result->bindParam(":waktu_tiba", $waktu_tiba);
            $result->bindParam(":id_rute", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePenumpang($nama_penumpang, $jenis_kelamin_penumpang, $no_hp_penumpang, $data){
        try{
            $sql ="UPDATE penumpang SET nama_penumpang=:nama_penumpang, jenis_kelamin_penumpang=:jenis_kelamin_penumpang, no_hp_penumpang=:no_hp_penumpang WHERE nik_penumpang=:nik_penumpang";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nama_penumpang", $nama_penumpang);
            $result->bindParam(":jenis_kelamin_penumpang", $jenis_kelamin_penumpang);
            $result->bindParam(":no_hp_penumpang", $no_hp_penumpang);
            $result->bindParam(":nik_penumpang", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePemesanan($nik_user, $nik_penumpang, $waktu_pemesanan, $total_bayar, $data){
        try{
            $sql ="UPDATE pemesanan SET nik_user=:nik_user, nik_penumpang=:nik_penumpang, waktu_pemesanan=:waktu_pemesanan, total_bayar=:total_bayar WHERE id_pemesanan=:id_pemesanan";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":nik_user", $nik_user);
            $result->bindParam(":nik_penumpang", $nik_penumpang);
            $result->bindParam(":waktu_pemesanan", $waktu_pemesanan);
            $result->bindParam(":total_bayar", $total_bayar);
            $result->bindParam(":id_pemesanan", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateDetailPemesanan($id_pemesanan, $id_bus, $jumlah_kursi_pesan, $data){
        try{
            $sql ="UPDATE detail_pemesanan SET id_pemesanan=:id_pemesanan, id_bus=:id_bus, jumlah_kursi_pesan=:jumlah_kursi_pesan WHERE id_detail_pemesanan=:id_detail_pemesanan";
            $result = $this->koneksi->prepare($sql);
            $result->bindParam(":id_pemesanan", $id_pemesanan);
            $result->bindParam(":id_bus", $id_bus);
            $result->bindParam(":jumlah_kursi_pesan", $jumlah_kursi_pesan);
            $result->bindParam(":id_detail_pemesanan", $data);
            $result->execute();
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    // delete
    public function deleteAdministrator($data){
        try{
            $sql ="DELETE FROM administrator WHERE id_user_admin=:id_user_admin";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_user_admin"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteUser($data){
        try{
            $sql ="DELETE FROM user WHERE nik_user=:nik_user";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("nik_user"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteBus($data){
        try{
            $sql ="DELETE FROM bus WHERE id_bus=:id_bus";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_bus"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteTerminal($data){
        try{
            $sql ="DELETE FROM terminal WHERE id_terminal=:id_terminal";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_terminal"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteJenisBus($data){
        try{
            $sql ="DELETE FROM jenis_bus WHERE id_jenis=:id_jenis";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_jenis"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteRute($data){
        try{
            $sql ="DELETE FROM rute WHERE id_rute=:id_rute";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_rute"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deletePenumpang($data){
        try{
            $sql ="DELETE FROM penumpang WHERE nik_penumpang=:nik_penumpang";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("nik_penumpang"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deletePemesanan($data){
        try{
            $sql ="DELETE FROM pemesanan WHERE id_pemesanan=:id_pemesanan";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_pemesanan"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteTiket($data){
        try{
            $sql ="DELETE FROM tiket WHERE id_tiket=:id_tiket";
            $result = $this->koneksi->prepare($sql);
            $result->execute(array("id_tiket"=>$data));
            return true;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
