package com.ProyectoFinal.ProyectoFinal.dao;

import com.ProyectoFinal.ProyectoFinal.domain.Tutorial;
import org.springframework.data.jpa.repository.JpaRepository;

public interface TutorialDao extends JpaRepository <Tutorial,Long>{
    
}
