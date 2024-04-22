package com.ProyectoFinal.ProyectoFinal.controller;

import com.ProyectoFinal.ProyectoFinal.domain.Contacto;
import com.ProyectoFinal.ProyectoFinal.service.ContactoService;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

@Controller
@Slf4j
@RequestMapping("/contacto")
public class ContactoController {

    @Autowired
    private ContactoService contactoService;

    @GetMapping("/list")
    public String inicio(Model model) {
        var contactos = contactoService.getContactos();
        model.addAttribute("Contactos", contactos);
        return "/contacto/list";
    }

    @PostMapping("/guardar")
    public String contactoGuardar(@RequestParam String nombre, @RequestParam String correo, @RequestParam String mensaje) {
        Contacto contacto = new Contacto();
        contacto.setNombre(nombre);
        contacto.setCorreo(correo);
        contacto.setMensaje(mensaje);
        contactoService.save(contacto);
        return "redirect:/index";
    }

    @GetMapping("/eliminar/{id}")
    public String contactEliminar(Contacto contacto) {
        contactoService.delete(contacto);
        return "redirect:/contacto/list";
    }

    @GetMapping("/contact")
    public String temporal() {
        return "/contacto/contact";
    }

}
