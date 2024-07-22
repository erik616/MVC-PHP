CREATE TABLE `tbl_conta_pagar` (
	`id_conta_pagar` INT(11) NOT NULL,
	`valor` DECIMAL(10,2) NOT NULL,
	`data_pagar` DATE NOT NULL,
	`pago` TINYINT(4) NOT NULL,
	`id_empresa` INT(11) NOT NULL,

	PRIMARY KEY (`id_conta_pagar`),
)
ENGINE=InnoDB;

CREATE TABLE `tbl_empresa` (
	`id_empresa` INT(11) NOT NULL,
	`nome` VARCHAR(255) NOT NULL,
    
	PRIMARY KEY (`id_empresa`)
)
ENGINE=InnoDB;


ALTER TABLE `tbl_conta_pagar` ADD CONSTRAINT  (`id_empresa`) REFERENCES `tbl_empresa` (`id_empresa`);