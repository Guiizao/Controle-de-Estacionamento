# Sistema de Controle de Estacionamento Inteligente

## Visão Geral

Este projeto implementa um sistema completo para gerenciamento de entradas e saídas de veículos em um estacionamento, incluindo cálculo automático de tarifas, controle de permanência e geração de relatórios consolidados.  
O desenvolvimento segue as diretrizes estabelecidas no documento oficial do trabalho acadêmico, utilizando princípios de engenharia de software e organização modular em camadas.

O sistema foi construído com foco em clareza, simplicidade arquitetural, responsabilidade única de cada módulo e autonomia entre componentes, visando facilitar manutenção, expansão e testes.

---

## Participantes

Vinicius Da Silva Gomes - RA 2010424

Guilherme Dalanora Dos Santos - RA 1991839

João Pereira Guerra - RA 2006484

---

## Objetivos do Projeto

- Registrar entradas e saídas de veículos.
- Calcular o valor devido com base no tipo de veículo e no tempo de permanência.
- Consolidar relatórios de uso e faturamento.
- Aplicar conceitos de:
  - Clean Code
  - SOLID
  - DRY
  - KISS
  - Object Calisthenics (aplicado moderadamente)
- Demonstrar domínio de arquitetura modular utilizando PHP, SQLite e Composer.

---

## Regras de Negócio

### Tipos de veículos e tarifas
| Tipo       | Tarifa por hora |
|------------|------------------|
| Carro      | R$ 5,00          |
| Moto       | R$ 3,00          |
| Caminhão   | R$ 10,00         |

### Detalhes das regras
- O cálculo do tempo é arredondado para cima.
- Cada registro contém:
  - Placa do veículo
  - Tipo do veículo
  - Data e hora de entrada
  - Data e hora de saída
- O relatório deve exibir:
  - Quantidade de veículos por tipo
  - Total faturado por tipo
  - Faturamento acumulado

---

## Arquitetura e Boas Práticas

### Clean Code
- Nomeação clara de funções, variáveis e classes.
- Separação estrita entre camadas.
- Simplicidade e padronização de estruturas.

### SOLID
- SRP: Cada classe possui apenas uma responsabilidade.
- OCP: Regras podem ser estendidas sem modificar código existente.
- LSP: Estratégias de cálculo são substituíveis sem impacto externo.
- ISP: Interfaces específicas para cada necessidade.
- DIP: Componentes dependem de abstrações.

### DRY
- Zero duplicação de regras de cálculo ou lógica de domínio.

### KISS
- Soluções diretas, sem complexidade desnecessária.
- Foco no essencial do fluxo do estacionamento.

### Object Calisthenics
- Métodos curtos.
- Classes pequenas.
- Baixo acoplamento.
- Estrutura orientada a objetos.

---

## Estrutura de Pastas

```
/
|-- index.php                   # Interface principal
|
|-- Application/                # Casos de uso e serviços
|
|-- Domain/                     # Entidades, repositórios e contratos
|     |-- Entities/
|     |-- ValueObjects/
|     |-- Repositories/
|
|-- Infra/                      # Implementações concretas
|     |-- Database/
|     |     |-- parking.db
|     |     |-- migrate.sql
|     |
|     |-- Repository/
|
|-- composer.json
|-- vendor/                      # Autoload gerado pelo Composer
```

---

## Banco de Dados

O projeto utiliza SQLite devido à leveza, simplicidade e compatibilidade com ambientes acadêmicos.

### Criando o banco
Execute:

```
sqlite3 Infra/Database/parking.db < Infra/Database/migrate.sql
```

**Observação**: Caso o comando `sqlite3` não seja reconhecido, siga as instruções abaixo para instalar o SQLite no seu sistema.

#### Instalando o SQLite:

1. Baixe o arquivo **`sqlite-tools-win-x64-3510000.zip`** (para sistemas Windows 64-bit) [aqui](https://www.sqlite.org/download.html).
2. Extraia o arquivo em uma pasta de sua escolha, como por exemplo `C:\sqlite`.
3. Adicione a pasta `C:\sqlite` ao seu PATH do sistema.
4. Verifique se a instalação foi concluída com sucesso executando o comando: sqlite3 --version

---

## Como Executar o Projeto

### 1. Instalar dependências
```
composer install
```

### 2. Executar o servidor PHP
Inicie o servidor PHP local com o seguinte comando (substitua o caminho conforme necessário):
```
php -S localhost:8080 -t C:\xampp\htdocs\Controle-de-Estacionamento-main
```

### 3. Acessar no navegador
Abra o navegador e acesse a URL abaixo para ver o projeto:

```
http://localhost:8080/index.php
```
---

## Possíveis erros comuns

### 1. **Erro: "sqlite3 não é reconhecido como um comando interno ou externo"**
- Isso ocorre quando o SQLite não está instalado corretamente ou não foi adicionado ao PATH do sistema. Verifique as instruções de instalação do SQLite na seção acima.

### 2. **Erro de porta já em uso**
- Caso o servidor não consiga iniciar devido à porta `8080` já estar em uso, tente usar outra porta, por exemplo `8081`:
  ```bash
  php -S localhost:8081 -t C:\xampp\htdocs\Controle-de-Estacionamento-main
---

## Uso do Sistema

### Registrar Entrada
Informe placa e tipo do veículo.  
O sistema grava o horário de entrada.

### Registrar Saída
Informe a mesma placa cadastrada.  
O sistema calcula automaticamente o valor devido.

### Consultar Relatório
Exibe:
- Quantidade de veículos por tipo
- Faturamento individual
- Total geral consolidado

---

## Entregáveis Conforme o Trabalho Acadêmico

- Código completo e organizado em camadas.
- README contendo instruções, justificativas e explicações técnicas.
- Repositório no GitHub.
- Demonstração funcional.
- Aplicação dos princípios exigidos no documento oficial.

---

## Conclusão

O sistema foi desenvolvido seguindo boas práticas de programação e organização arquitetural, garantindo clareza, modularidade e possibilidade de manutenção futura.  
O foco deste projeto é aplicar de forma correta os princípios fundamentais de engenharia de software, atendendo às exigências acadêmicas e simulando um ambiente real de desenvolvimento.

---

# Fotos do Sistema
V1:
<img width="694" height="326" alt="image" src="https://github.com/user-attachments/assets/68ff8a35-51f4-4f92-9400-2abb51d6696c" />



