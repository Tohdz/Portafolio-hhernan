package com.ProyectoFinal.ProyectoFinal.dao;

import com.ProyectoFinal.ProyectoFinal.domain.Noticia;
import org.springframework.data.jpa.repository.JpaRepository;

public interface NoticiaDao extends JpaRepository <Noticia,Long>{
    
}