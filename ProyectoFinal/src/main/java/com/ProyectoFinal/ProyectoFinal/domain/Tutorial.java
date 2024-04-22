package com.ProyectoFinal.ProyectoFinal.domain;

import jakarta.persistence.*;
import java.io.Serializable;
import lombok.Data;

@Data
@Entity
@Table(name="tutorial")

public class Tutorial implements Serializable {
    
    private static final long serialVersionUID= 1L;
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name="id")
    private Long id;
    @Column(name="imagen")
    private String imagen;
    @Column(name="titulo")
    private String titulo;
    @Column(name="cuerpo")
    private String cuerpo;

    public Tutorial() {
    }

    public Tutorial(Long id, String imagen, String titulo, String cuerpo) {
        this.id = id;
        this.imagen = imagen;
        this.titulo = titulo;
        this.cuerpo = cuerpo;
    }  
}