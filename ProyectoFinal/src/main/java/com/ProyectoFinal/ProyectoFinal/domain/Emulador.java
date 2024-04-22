
package com.ProyectoFinal.ProyectoFinal.domain;

import jakarta.persistence.*;
import java.io.Serializable;
import lombok.Data;

@Data
@Entity
@Table(name="emulador")
public class Emulador implements Serializable{
    
    private static final long serialVersionUID= 1L;
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name="id")
    private Long id;
    @Column(name="nombre")
    private String nombre;
    @Column(name="consola")
    private String consola;
    @Column(name="year")
    private String year;
    @Column(name="descripcion")
    private String descripcion;
    @Column(name="descarga")
    private String descarga;
    @Column(name="imagen")
    private String imagen;
    
    
    public Emulador() {
    }

    public Emulador(Long id, String nombre, String consola, String year, String descripcion, String descarga, String imagen) {
        this.id = id;
        this.nombre = nombre;
        this.consola = consola;
        this.year = year;
        this.descripcion = descripcion;
        this.descarga = descarga;
        this.imagen = imagen;
    }

   

    
    
    
}
