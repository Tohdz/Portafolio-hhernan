package com.ProyectoFinal.ProyectoFinal.domain;

import jakarta.persistence.*;
import java.io.Serializable;
import lombok.Data;

@Data
@Entity
@Table(name="games")

public class Game implements Serializable {
    
    private static final long serialVersionUID= 1L;
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name="id")
    private Long id;
    @Column(name="created_at")
    private String created_at;
    @Column(name="year")
    private int year;
    @Column(name="emulator")
    private String emulator;
    @Column(name="description")
    private String description;
    @Column(name="name")
    private String name;
    @Column(name="extension")
    private String extension;
    @Column(name="bios")
    private String bios;

    public Game() {
    }

    public Game(Long id, String created_at, int year, String emulator, String description, String name, String extension, String bios) {
        this.id = id;
        this.created_at = created_at;
        this.year = year;
        this.emulator = emulator;
        this.description = description;
        this.name = name;
        this.extension = extension;
        this.bios = bios;
    }
}