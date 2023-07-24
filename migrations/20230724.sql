ALTER TABLE db_pembayaran ADD urut int(4) NULL;
ALTER TABLE db_penjualan DROP COLUMN kode_trx;
ALTER TABLE db_penjualan MODIFY nota varchar(20);
ALTER TABLE db_pembayaran MODIFY nota varchar(20);
ALTER TABLE db_penjualan ADD id_pembayaran int(11);
ALTER TABLE db_penjualan ADD FOREIGN KEY (id_pembayaran) REFERENCES db_pembayaran(no);
ALTER TABLE db_pembayaran ADD tanggal DATE;