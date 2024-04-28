/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package tienda.demo.dao;

import org.springframework.data.jpa.repository.JpaRepository;
import tienda.demo.domain.Rol;

/**
 *
 * @author hhern
 */
public interface RolDao extends JpaRepository <Rol, Long> {
    
}
