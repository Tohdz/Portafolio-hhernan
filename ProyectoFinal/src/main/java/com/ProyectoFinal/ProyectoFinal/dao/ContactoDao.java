package com.ProyectoFinal.ProyectoFinal.dao;

import com.ProyectoFinal.ProyectoFinal.domain.Contacto;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ContactoDao extends JpaRepository <Contacto,Long>{
    
}
